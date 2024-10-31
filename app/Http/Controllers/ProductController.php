<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;

use App\Models\Product;
use App\Models\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function main()
    {
        $products = Product::leftJoin('companies', 'products.comp_id', '=', 'companies.id')
            ->select('products.*', 'companies.name as com_name', 'companies.id as com_id')
            ->paginate(10);

        $companies = Company::all();

        return view('products.product', compact('products', 'companies'));
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $type = $file->getClientOriginalExtension();

            $fileName = date('Y-m-d') . '_' . time() . '.' . $type;

            $file->move('Images/', $fileName);

            $data['image'] = 'Images/' . $fileName;
        }


        Product::create($data);

        return redirect()->route('product.main')->with('check', ['Успешно добавлено данные', 'success']);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $updatedData = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $type = $file->getClientOriginalExtension();

            $fileName = date('Y-m-d') . '_' . time() . '.' . $type;

            $file->move('Images/', $fileName);

            $updatedData['image'] = 'Images/' . $fileName;
        } else {
            $updatedData['image'] = $product['image'];
        }

        $updatedData['name'] = !empty($request['name']) ? $request['name'] : $product->name;
        $updatedData['comp_id'] = !empty($request['comp_id']) ? $request['comp_id'] : $product->comp_id;
        $updatedData['price'] = !empty($request['price']) ? $request['price'] : $product->price;

        $product->update($updatedData);

        return redirect()->route('product.main')->with('check', ['Успешно обновлено данные', 'primary']);
    }
    public function search(Request $request)
    {
        $products = Product::leftJoin('companies', 'products.comp_id', '=', 'companies.id')
            ->select('products.*', 'companies.name as com_name', 'companies.id as com_id')
            ->where('products.name', 'LIKE', '%'. $request->search .'%')
            ->orderBy('id','desc')
            ->paginate(10);

        $companies = Company::all();

        return view('products.product', compact('products', 'companies'));

    }
    public function delete(Product $id)
    {
        $id->delete();
        return redirect()->route('product.main')->with('check', ['Успешно удалено данные', 'danger']);
    }
    public function deleteAll()
    {
        Product::query()->delete();
        return redirect()->route('product.main')->with('check', ['Успешно удалено все данные!', 'danger']);
    }
}
