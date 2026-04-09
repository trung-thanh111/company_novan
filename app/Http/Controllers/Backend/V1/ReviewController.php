<?php

namespace App\Http\Controllers\Backend\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\V1\Core\ReviewService;
use App\Repositories\Core\ReviewRepository;

class ReviewController extends Controller
{
    protected $reviewService;
    protected $reviewRepository;

    public function __construct(
        ReviewService $reviewService,
        ReviewRepository $reviewRepository,
    ){
        $this->reviewService = $reviewService;
        $this->reviewRepository = $reviewRepository;
    }

    public function index(Request $request){
        $this->authorize('modules', 'review.index');
        $reviews = $this->reviewService->paginate($request);
        $config = [
            'js' => [
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' => [
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'model' => 'Review'
        ];
        $config['seo'] = __('messages.review');
        $template = 'backend.review.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'reviews'
        ));
    }

    public function create()
    {
        $this->authorize('modules', 'review.create');
        $config = $this->config();
        $config['seo'] = __('messages.review');
        $config['method'] = 'create';
        $record = new \App\Models\Review();
        $template = 'backend.review.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
        ));
    }

    public function store(Request $request)
    {
        $this->authorize('modules', 'review.create');
        $payload = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'score' => ['required', 'integer', 'min:1', 'max:5'],
            'status' => ['nullable', 'integer'],
        ]);

        $payload['status'] = $payload['status'] ?? 1;
        $this->reviewRepository->create($payload);

        return redirect()->route('review.index')->with('success', 'Thêm đánh giá thành công');
    }

    public function edit($id)
    {
        $this->authorize('modules', 'review.update');
        $config = $this->config();
        $config['seo'] = __('messages.review');
        $config['method'] = 'edit';
        $record = $this->reviewRepository->findById($id);
        $template = 'backend.review.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'record',
        ));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('modules', 'review.update');
        $payload = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'score' => ['required', 'integer', 'min:1', 'max:5'],
            'status' => ['nullable', 'integer'],
        ]);

        $payload['status'] = $payload['status'] ?? 1;
        $this->reviewRepository->update($id, $payload);

        return redirect()->route('review.index')->with('success', 'Cập nhật đánh giá thành công');
    }

    public function delete($id){
        $this->authorize('modules', 'review.destroy');
        $config['seo'] = __('messages.review');
        $review = $this->reviewRepository->findById($id);
        $template = 'backend.review.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'review',
            'config',
        ));
    }

    public function destroy($id){
        if($this->reviewService->destroy($id)){
            return redirect()->route('review.index')->with('success','Xóa bản ghi thành công');
        }
        return redirect()->route('review.index')->with('error','Xóa bản ghi không thành công. Hãy thử lại');
    }

    
    private function config(){
        return [
            'css' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
            'js' => [
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                'backend/plugins/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/widget.js',
                'backend/plugins/ckeditor/ckeditor.js',
            ]
        ];
    }

}
