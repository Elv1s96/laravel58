<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
//use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
/**
 * Управление категориями блога
 *
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paginator = BlogCategory::paginate(15); // Выбираем сколько записей будет на одной страницы пагинатора
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);
        return view('blog.admin.categories.index', compact('paginator'));
        //dd(__METHOD__);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new BlogCategory();
        //$categoryList = BlogCategory::all();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));
        //dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        // Ушло в обсервер
//        if(empty($data['slug'])){
//            $data['slug'] = \Str::slug($data['title']);
//        }
        //Создаст объект но не добавит в БД
        //$item = new BlogCategory($data);
       // $item->save();
        $item = (new BlogCategory())->create($data);
        if($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()->withErrors(['msg' => 'ошибка сохранения'])
                ->withInput();
        }
        //dd(__METHOD__);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
//        $item = $this->blogCategoryRepository->getEdit($id);
//        $v['title_before'] = $item->title;
//        $item->title = 'ASDasasdsaSD aqdasdsa 1231';
//
//        $v['title_after'] = $item->title;
//        $v['getAttribute'] = $item->getAttribute('title');
//        $v['attributesToArray'] = $item->attributesToArray();
//        $v['attributes'] = $item->attributes['title'];
//        $v['getAttributeValue'] = $item->getAttributeValue('title');
//        $v['getMutatedAttributes'] = $item->getMutatedAttributes();
//        $v['hasGetMutator for title'] = $item->hasGetMutator('title');
//        $v['toArray'] = $item->toArray();
        //dd($v,$item);

        //$item = BlogCategory::findOrFail($id);
        //$categoryList = BlogCategory::all();
        //$item = $categoryRepository->getEdit($id);
        $item = $this->blogCategoryRepository->getEdit($id);
        //$categoryList = $categoryRepository->getForComboBox();
        if(empty($item)) {
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));
        //dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogCategoryUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
//        $rules = [
//            'title'       => 'required|min:5|max:200',
//            'slug'        => 'max:200',
//            'description' => 'string|max:500|min:3',
//            'parent_id'   => 'required|integer|exists:blog_categories,id',
//        ];
       // $validateData = $this->validate($request, $rules); // Обращаемся к контроллеру
        //$validateData = $request->validate($rules); // Придут такие же данные, как в 85 строке. Обращаемся к реквесту
//        $validator = \Validator::make($request->all(), $rules);
//        $validateData[] = $validator->passes();
//        //$validateData[] = $validator->validate();
//        $validateData[] = $validator->valid();
//        $validateData[] = $validator->failed();
//        $validateData[] = $validator->errors();
//        $validateData[] = $validator->fails();
//        dd($validateData);


        //$item = BlogCategory::find($id); //возвращает или обьект по id или 0
     $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput(); //При ошибке введенные данные в инпут останутся
        }
        $data = $request->all();
        //Дубль кода
        //Ушло в обсервер
//        if(empty($data['slug'])){
//            $data['slug'] = \Str::slug($data['title']);
//        }
        $result = $item->update($data);
        //$result = $item
         //   ->fill($data)
          //  ->save();

        if($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошика сохранения'])
                ->withInput();
        }
        //dd(__METHOD__,$request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
