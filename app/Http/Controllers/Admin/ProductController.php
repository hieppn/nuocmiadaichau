<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Factory;
use App\Models\Product;
use App\Models\Producer;
use App\Models\Promotion;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Models\OrderDetail;

class ProductController extends Controller
{
  public function index()
  {
    $products = Product::select('id', 'producer_id', 'name', 'image', 'sku_code', 'model', 'rate', 'created_at')
      ->whereHas('product_details', function (Builder $query) {
        $query->where('import_quantity', '>', 0);
      })
      ->with([
        'producer' => function ($query) {
          $query->select('id', 'name');
        }
      ])
      ->withCount([
        'product_details' => function (Builder $query) {
          $query->where([['import_quantity', '>', 0], ['quantity', '>', 0]]);
        }
      ])->latest()->get();
    return view('admin.product.index')->with('products', $products);
  }

  public function delete(Request $request)
  {
    $product = Product::whereHas('product_details', function (Builder $query) {
      $query->where('import_quantity', '>', 0);
    })->where('id', $request->product_id)->first();

    if (!$product) {

      $data['type'] = 'error';
      $data['title'] = 'Thất Bại';
      $data['content'] = 'Bạn không thể xóa sản phẩm không tồn tại!';
    } else {

      $can_delete = 1;
      $product_details = $product->product_details;
      foreach ($product_details as $product_detail) {
        if ($product_detail->import_quantity == 0 || $product_detail->import_quantity != $product_detail->quantity) {
          $can_delete = 0;
          break;
        }
      }

      if ($can_delete) {

        foreach ($product_details as $product_detail) {
          foreach ($product_detail->product_images as $image) {
            $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
            $storage = $factory->createStorage();
            $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
            $object = $bucket->object($image->image_name);
            $object->delete();
            $image->delete();
          }
          $product_detail->delete();
        }
        foreach ($product->promotions as $promotion) {
          $promotion->delete();
        }
        foreach ($product->product_votes as $product_vote) {
          $product_vote->delete();
        }
        $product->delete();
      } else {
        foreach ($product_details as $product_detail) {
          if ($product_detail->import_quantity > 0 && $product_detail->import_quantity == $product_detail->quantity) {

            foreach ($product_detail->product_images as $image) {
              $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
              $storage = $factory->createStorage();
              $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
              $object = $bucket->object($image->image_name);
              $object->delete();
              $image->delete();
            }
            $product_detail->delete();
          } else {

            $product_detail->import_quantity = 0;
            $product_detail->quantity = 0;
            $product_detail->save();
          }
        }
        foreach ($product->promotions as $promotion) {
          $promotion->delete();
        }
      }

      $data['type'] = 'success';
      $data['title'] = 'Thành Công';
      $data['content'] = 'Xóa sản phẩm thành công!';
    }

    return response()->json($data, 200);
  }

  public function new(Request $request)
  {
    $producers = Producer::select('id', 'name')->orderBy('name', 'asc')->get();
    return view('admin.product.new')->with('producers', $producers);
  }

  public function save(Request $request)
  {
    $product = new Product;

    if ($request->information_details != null) {
      $information_details = $request->information_details;
      $dom = new \DomDocument();
      $information_details = mb_convert_encoding($information_details, 'HTML-ENTITIES', "UTF-8");
      $dom->loadHtml($information_details, LIBXML_HTML_NODEFDTD);
      $images = $dom->getElementsByTagName('img');
      foreach ($images as $k => $img) {
        $image_name = time() . '_' . uniqid() . '.png';
        $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
        $storage = $factory->createStorage();
        $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
        $bucket->upload(
          file_get_contents($img->getAttribute('src')),
          [
            'name' => $image_name,
            'alt' => 'media'
          ]
        );

        $img->removeAttribute('src');
        $img->setAttribute('src', 'https://firebasestorage.googleapis.com/v0/b/nuocmiasaigon-fc089.appspot.com/o/' . $image_name . '?alt=media');
      }

      $information_details = $dom->saveHTML();

      //conver html-entities to utf-8
      $information_details = mb_convert_encoding($information_details, "UTF-8", 'HTML-ENTITIES');

      //get content
      list(, $information_details) = explode('<html><body>', $information_details);
      list($information_details,) = explode('</body></html>', $information_details);

      $product->information_details = $information_details;
    }
    if ($request->product_introduction != null) {
      //Xử lý Ảnh trong nội dung
      $product_introduction = $request->product_introduction;

      $dom = new \DomDocument();

      // conver utf-8 to html entities
      $product_introduction = mb_convert_encoding($product_introduction, 'HTML-ENTITIES', "UTF-8");

      $dom->loadHtml($product_introduction, LIBXML_HTML_NODEFDTD);

      $images = $dom->getElementsByTagName('img');

      foreach ($images as $k => $img) {

        $image_name = time() . '_' . uniqid() . '.png';
        $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
        $storage = $factory->createStorage();
        $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
        $bucket->upload(
          file_get_contents($img->getAttribute('src')),
          [
            'name' => $image_name,
            'alt' => 'media'
          ]
        );

        $img->removeAttribute('src');
        $img->setAttribute('src', 'https://firebasestorage.googleapis.com/v0/b/nuocmiasaigon-fc089.appspot.com/o/' . $image_name . '?alt=media');
      }

      $product_introduction = $dom->saveHTML();

      //conver html-entities to utf-8
      $product_introduction = mb_convert_encoding($product_introduction, "UTF-8", 'HTML-ENTITIES');

      //get content
      list(, $product_introduction) = explode('<html><body>', $product_introduction);
      list($product_introduction,) = explode('</body></html>', $product_introduction);

      $product->product_introduction = $product_introduction;
    }

    $product->name = $request->name;
    $product->producer_id = $request->producer_id;
    $product->sku_code = $request->sku_code;
    $product->productivity = $request->productivity;
    $product->vol = $request->vol;
    $product->wat = $request->wat;
    $product->bearings = $request->bearings;
    $product->speed = $request->speed;
    $product->weight = $request->weight;
    $product->size = $request->size;
    $product->model = $request->model;
    $product->insurance = $request->insurance;
    $product->rate = 5.0;

    if ($request->hasFile('image')) {
      $image_name = time() . uniqid() . '_' . $_FILES['image']['name'];
      $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
      $storage = $factory->createStorage();
      $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
      $bucket->upload(
        file_get_contents($_FILES['image']['tmp_name']),
        [
          'name' => $image_name,
          'alt' => 'media'
        ]
      );
      $product->image = $image_name;
    }

    $product->save();

    if ($request->has('product_promotions')) {
      foreach ($request->product_promotions as $product_promotion) {
        $promotion = new Promotion;
        $promotion->product_id = $product->id;
        $promotion->content = $product_promotion['content'];

        //Xử lý ngày bắt đầu, ngày kết thúc
        list($start_date, $end_date) = explode(' - ', $product_promotion['promotion_date']);

        $start_date = str_replace('/', '-', $start_date);
        $start_date = date('Y-m-d', strtotime($start_date));

        $end_date = str_replace('/', '-', $end_date);
        $end_date = date('Y-m-d', strtotime($end_date));

        $promotion->start_date = $start_date;
        $promotion->end_date = $end_date;

        $promotion->save();
      }
    }

    if ($request->has('product_details')) {
      foreach ($request->product_details as $key => $product_detail) {
        $new_product_detail = new ProductDetail;
        $new_product_detail->product_id = $product->id;
        $new_product_detail->design = $product_detail['design'];
        $new_product_detail->import_quantity = $product_detail['quantity'];
        $new_product_detail->quantity = $product_detail['quantity'];
        $new_product_detail->import_price = str_replace('.', '', $product_detail['import_price']);
        $new_product_detail->sale_price = str_replace('.', '', $product_detail['sale_price']);
        if ($product_detail['promotion_price'] != null) {
          $new_product_detail->promotion_price = str_replace('.', '', $product_detail['promotion_price']);
        }
        if ($product_detail['promotion_date'] != null) {
          //Xử lý ngày bắt đầu, ngày kết thúc
          list($start_date, $end_date) = explode(' - ', $product_detail['promotion_date']);

          $start_date = str_replace('/', '-', $start_date);
          $start_date = date('Y-m-d', strtotime($start_date));

          $end_date = str_replace('/', '-', $end_date);
          $end_date = date('Y-m-d', strtotime($end_date));

          $new_product_detail->promotion_start_date = $start_date;
          $new_product_detail->promotion_end_date = $end_date;
        }

        $new_product_detail->save();
        $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
        $storage = $factory->createStorage();
        $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
        foreach ($request->file('product_details')[$key]['images'] as $image) {
          $image_name = time() . uniqid() . '_' . $image->getClientOriginalName();
          $bucket->upload(
            file_get_contents($image),
            [
              'name' => $image_name,
              'alt' => 'media'
            ]
          );

          $new_image = new ProductImage;
          $new_image->product_detail_id = $new_product_detail->id;
          $new_image->image_name = $image_name;

          $new_image->save();
        }
      }
    }

    return redirect()->route('admin.product.index')->with(['alert' => [
      'type' => 'success',
      'title' => 'Thành Công',
      'content' => 'Thêm sản phẩm thành công.'
    ]]);
  }

  public function edit($id)
  {
    $producers = Producer::select('id', 'name')->orderBy('name', 'asc')->get();
    $product = Product::select('id', 'producer_id', 'name', 'image', 'sku_code', 'productivity', 'vol', 'wat', 'bearings', 'speed', 'weight', 'size', 'model', 'insurance', 'information_details', 'product_introduction')
      ->whereHas('product_details', function (Builder $query) {
        $query->where('import_quantity', '>', 0);
      })->where('id', $id)->with([
        'promotions' => function ($query) {
          $query->select('id', 'product_id', 'content', 'start_date', 'end_date');
        },
        'product_details' => function ($query) {
          $query->select('id', 'product_id', 'design', 'import_quantity', 'import_price', 'sale_price', 'promotion_price', 'promotion_start_date', 'promotion_end_date')->where('import_quantity', '>', 0)
            ->with([
              'product_images' => function ($query) {
                $query->select('id', 'product_detail_id', 'image_name');
              },
              'order_details' => function ($query) {
                $query->select('id', 'product_detail_id', 'quantity');
              }
            ]);
        }
      ])->first();
    if (!$product) abort(404);
    return view('admin.product.edit')->with(['product' => $product, 'producers' => $producers]);
  }

  public function update(Request $request, $id)
  {

    $product = Product::whereHas('product_details', function (Builder $query) {
      $query->where('import_quantity', '>', 0);
    })->where('id', $id)->first();
    if (!$product) abort(404);

    if ($request->information_details != null) {
      //Xử lý Ảnh trong nội dung
      $information_details = $request->information_details;

      $dom = new \DomDocument();

      // conver utf-8 to html entities
      $information_details = mb_convert_encoding($information_details, 'HTML-ENTITIES', "UTF-8");

      $dom->loadHtml($information_details, LIBXML_HTML_NODEFDTD);

      $images = $dom->getElementsByTagName('img');

      foreach ($images as $k => $img) {
        $image_name = time() . '_' . uniqid() . '.png';
        $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
        $storage = $factory->createStorage();
        $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
        $bucket->upload(
          file_get_contents($img->getAttribute('src')),
          [
            'name' => $image_name,
            'alt' => 'media'
          ]
        );

        $img->removeAttribute('src');
        $img->setAttribute('src', 'https://firebasestorage.googleapis.com/v0/b/nuocmiasaigon-fc089.appspot.com/o/' . $image_name . '?alt=media');
      }

      $information_details = $dom->saveHTML();

      //conver html-entities to utf-8
      $information_details = mb_convert_encoding($information_details, "UTF-8", 'HTML-ENTITIES');

      //get content
      list(, $information_details) = explode('<html><body>', $information_details);
      list($information_details,) = explode('</body></html>', $information_details);

      $product->information_details = $information_details;
    }
    if ($request->product_introduction != null) {
      //Xử lý Ảnh trong nội dung
      $product_introduction = $request->product_introduction;

      $dom = new \DomDocument();

      // conver utf-8 to html entities
      $product_introduction = mb_convert_encoding($product_introduction, 'HTML-ENTITIES', "UTF-8");

      $dom->loadHtml($product_introduction, LIBXML_HTML_NODEFDTD);

      $images = $dom->getElementsByTagName('img');

      foreach ($images as $k => $img) {
        $image_name = time() . '_' . uniqid() . '.png';
        $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
        $storage = $factory->createStorage();
        $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
        $bucket->upload(
          file_get_contents($img->getAttribute('src')),
          [
            'name' => $image_name,
            'alt' => 'media'
          ]
        );

        $img->removeAttribute('src');
        $img->setAttribute('src', 'https://firebasestorage.googleapis.com/v0/b/nuocmiasaigon-fc089.appspot.com/o/' . $image_name . '?alt=media');
      }

      $product_introduction = $dom->saveHTML();

      //conver html-entities to utf-8
      $product_introduction = mb_convert_encoding($product_introduction, "UTF-8", 'HTML-ENTITIES');

      //get content
      list(, $product_introduction) = explode('<html><body>', $product_introduction);
      list($product_introduction,) = explode('</body></html>', $product_introduction);

      $product->product_introduction = $product_introduction;
    }

    $product->name = $request->name;
    $product->producer_id = $request->producer_id;
    $product->sku_code = $request->sku_code;
    $product->productivity = $request->productivity;
    $product->vol = $request->vol;
    $product->wat = $request->wat;
    $product->bearings = $request->bearings;
    $product->speed = $request->speed;
    $product->weight = $request->weight;
    $product->size = $request->size;
    $product->model = $request->model;
    $product->insurance = $request->insurance;

    if ($request->hasFile('image')) {
      $image_name = time() . uniqid() . '_' . $_FILES['image']['name'];
      $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
      $storage = $factory->createStorage();
      $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
      $bucket->upload(
        file_get_contents($_FILES['image']['tmp_name']),
        [
          'name' => $image_name,
          'alt' => 'media'
        ]
      );
      $product->image = $image_name;
    }

    $product->save();
    if ($request->has('old_product_promotions')) {
      foreach ($request->old_product_promotions as $key => $old_product_promotion) {
        $promotion = Promotion::where('id', $key)->first();
        if (!$promotion) abort(404);

        $promotion->content = $old_product_promotion['content'];

        //Xử lý ngày bắt đầu, ngày kết thúc
        list($start_date, $end_date) = explode(' - ', $old_product_promotion['promotion_date']);

        $start_date = str_replace('/', '-', $start_date);
        $start_date = date('Y-m-d', strtotime($start_date));

        $end_date = str_replace('/', '-', $end_date);
        $end_date = date('Y-m-d', strtotime($end_date));

        $promotion->start_date = $start_date;
        $promotion->end_date = $end_date;

        $promotion->save();
      }
    }

    if ($request->has('product_promotions')) {
      foreach ($request->product_promotions as $product_promotion) {
        $promotion = new Promotion;
        $promotion->product_id = $product->id;
        $promotion->content = $product_promotion['content'];

        //Xử lý ngày bắt đầu, ngày kết thúc
        list($start_date, $end_date) = explode(' - ', $product_promotion['promotion_date']);

        $start_date = str_replace('/', '-', $start_date);
        $start_date = date('Y-m-d', strtotime($start_date));

        $end_date = str_replace('/', '-', $end_date);
        $end_date = date('Y-m-d', strtotime($end_date));

        $promotion->start_date = $start_date;
        $promotion->end_date = $end_date;

        $promotion->save();
      }
    }

    if ($request->has('old_product_details')) {
      foreach ($request->old_product_details as $key => $product_detail) {
        $sum = OrderDetail::where('product_detail_id', $key)->sum('quantity');
        $old_product_detail = ProductDetail::where('id', $key)->first();
        if (!$old_product_detail) abort(404);

        $old_product_detail->design = $product_detail['design'];
        $old_product_detail->import_quantity = $product_detail['quantity'];
        $old_product_detail->quantity = $product_detail['quantity'] - $sum;
        $old_product_detail->import_price = str_replace('.', '', $product_detail['import_price']);
        $old_product_detail->sale_price = str_replace('.', '', $product_detail['sale_price']);
        if ($product_detail['promotion_price'] != null) {
          $old_product_detail->promotion_price = str_replace('.', '', $product_detail['promotion_price']);
        }
        if ($product_detail['promotion_date'] != null) {
          //Xử lý ngày bắt đầu, ngày kết thúc
          list($start_date, $end_date) = explode(' - ', $product_detail['promotion_date']);

          $start_date = str_replace('/', '-', $start_date);
          $start_date = date('Y-m-d', strtotime($start_date));

          $end_date = str_replace('/', '-', $end_date);
          $end_date = date('Y-m-d', strtotime($end_date));

          $old_product_detail->promotion_start_date = $start_date;
          $old_product_detail->promotion_end_date = $end_date;
        }

        $old_product_detail->save();
      }
    }

    if ($request->has('product_details')) {
      $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
      $storage = $factory->createStorage();
      $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
      foreach ($request->product_details as $key => $product_detail) {
        $new_product_detail = new ProductDetail;
        $new_product_detail->product_id = $product->id;
        $new_product_detail->design = $product_detail['design'];
        $new_product_detail->import_quantity = $product_detail['quantity'];
        $new_product_detail->quantity = $product_detail['quantity'];
        $new_product_detail->import_price = str_replace('.', '', $product_detail['import_price']);
        $new_product_detail->sale_price = str_replace('.', '', $product_detail['sale_price']);
        if ($product_detail['promotion_price'] != null) {
          $new_product_detail->promotion_price = str_replace('.', '', $product_detail['promotion_price']);
        }
        if ($product_detail['promotion_date'] != null) {
          //Xử lý ngày bắt đầu, ngày kết thúc
          list($start_date, $end_date) = explode(' - ', $product_detail['promotion_date']);

          $start_date = str_replace('/', '-', $start_date);
          $start_date = date('Y-m-d', strtotime($start_date));

          $end_date = str_replace('/', '-', $end_date);
          $end_date = date('Y-m-d', strtotime($end_date));

          $new_product_detail->promotion_start_date = $start_date;
          $new_product_detail->promotion_end_date = $end_date;
        }

        $new_product_detail->save();

        foreach ($request->file('product_details')[$key]['images'] as $image) {
          $image_name = time() . uniqid() . '_' . $image->getClient;
          $bucket->upload(
            file_get_contents($image),
            [
              'name' => $image_name,
              'alt' => 'media'
            ]
          );
          $new_image = new ProductImage;
          $new_image->product_detail_id = $new_product_detail->id;
          $new_image->image_name = $image_name;

          $new_image->save();
        }
      }
    }

    if ($request->file('old_product_details') != null) {
      $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
      $storage = $factory->createStorage();
      $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
      foreach ($request->file('old_product_details') as $key => $images) {
        foreach ($images['images'] as $image) {
          $image_name = time() . uniqid() . '.png';
          $bucket->upload(
            file_get_contents($image),
            [
              'name' => $image_name,
              'alt' => 'media'
            ]
          );
          $new_image = new ProductImage;
          $new_image->product_detail_id = $key;
          $new_image->image_name = $image_name;
          $new_image->save();
        }
      }
    }

    return redirect()->route('admin.product.index')->with(['alert' => [
      'type' => 'success',
      'title' => 'Thành Công',
      'content' => 'Chỉnh sửa sản phẩm thành công.'
    ]]);
  }

  public function delete_promotion(Request $request)
  {
    $promotion = Promotion::where('id', $request->promotion_id)->first();

    if (!$promotion) {

      $data['type'] = 'error';
      $data['title'] = 'Thất Bại';
      $data['content'] = 'Bạn không thể xóa khuyễn mãi không tồn tại!';
    } else {

      $promotion->delete();

      $data['type'] = 'success';
      $data['title'] = 'Thành Công';
      $data['content'] = 'Xóa khuyến mãi thành công!';
    }

    return response()->json($data, 200);
  }

  public function delete_product_detail(Request $request)
  {
    $product_detail = ProductDetail::where([['id', $request->product_detail_id], ['import_quantity', '>', 0]])->first();

    if (!$product_detail) {

      $data['type'] = 'error';
      $data['title'] = 'Thất Bại';
      $data['content'] = 'Bạn không thể xóa chi tiết sản phẩm không tồn tại!';
    } else {

      if ($product_detail->import_quantity == $product_detail->quantity) {
        $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
        $storage = $factory->createStorage();
        $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
        foreach ($product_detail->product_images as $image) {
          $object = $bucket->object($image->image_name);
          $object->delete();
          ProductImage::where('image_name', $image->image_name)->delete();
        }
        $product_detail->delete();
      } else {
        $product_detail->import_quantity = 0;
        $product_detail->quantity = 0;
        $product_detail->save();
      }

      $data['type'] = 'success';
      $data['title'] = 'Thành Công';
      $data['content'] = 'Xóa chi tiết sản phẩm thành công!';
    }

    return response()->json($data, 200);
  }

  public function delete_image(Request $request)
  {
    $image = ProductImage::find($request->key);
    $factory = (new Factory)->withServiceAccount(base_path() . '/' . 'firebase_credential.json');
    $storage = $factory->createStorage();
    $bucket = $storage->getBucket('nuocmiasaigon-fc089.appspot.com');
    $object = $bucket->object($image->image_name);
    $object->delete();
    $image->delete();
    return response()->json();
  }
}
