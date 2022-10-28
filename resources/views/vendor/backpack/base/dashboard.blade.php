@extends(backpack_view('blank'))

@php
	$postCount = \App\Models\Post::count();
	$commentCount = \App\Models\Comment::count();
	$userCount = \App\Models\User::count();
	$categoryCount = \App\Models\Category::count();

	$recentPosts = \App\Models\Post::orderBy('created_at', 'DESC')->take(5)->get();
	$recentComments = \App\Models\Comment::orderBy('created_at', 'DESC')->take(5)->get();

	// $mostCommentedPosts = \App\Models\Post::withCount('comments')->orderBy('comments_count', 'DESC')->take(5)->get();
	// dd($recentPosts);
	Widget::add()->to('before_content')->type('div')->class('row')->content([
		Widget::make()
			->type('progress')
			->class('card border-0 bg-primary text-white mb-2')
			->value($postCount)
			->description('Posts')
			->hint("$postCount posts")
			->wrapper(['class' => 'col-md-3']),
		Widget::make()
			->type('progress')
			->class('card border-0 bg-warning text-white mb-2')
			->value($commentCount)
			->description('Comments')
			->hint("$commentCount comments")
			->wrapper(['class' => 'col-md-3']),
		Widget::make()
			->type('progress')
			->class('card border-0 bg-success text-white mb-2')
			->value($userCount)
			->description('Users')
			->hint("$userCount users")
			->wrapper(['class' => 'col-md-3']),
		Widget::make()
			->type('progress')
			->class('card border-0 bg-danger text-white mb-2')
			->value($categoryCount)
			->description('Categories')
			->hint("$categoryCount categories")
			->wrapper(['class' => 'col-md-3']),
]);

	// Sample Chart
	Widget::add()->to('before_content')->type('div')->class('row')->content([
		[
			'type' => 'chart',
			'controller' => \App\Http\Controllers\Admin\Charts\SampleChartController::class,
			'class' => 'card border-0 mb-2',
			'wrapper' => ['class' => 'col-md-12'],
			'content' => [
				'header' => 'Sample Chart',
				'refresh' => 30,
				'height' => '300px',
				'width' => '100%',
			],
		],[
			// List Recent
			'type' => 'card',	
			'class' => 'card border-0 mb-2',
			'wrapper' => ['class' => 'col-md-6'],
			'content' => [
				'body' => view('vendor.backpack.base.inc.widgets.recent-posts', [
					'posts' => $recentPosts, 
					'comments' => $recentComments
				]),
				
			],
		],[
			// Chart Visitors
			'type' => 'chart',
			'chart_type' => 'line',
			'controller' => \App\Http\Controllers\Admin\Charts\VisitorChartController::class,
			'class' => 'card border-0 mb-2',
			'wrapper' => ['class' => 'col-md-6'],
			'content' => [
				'header' => 'Visitors',
				'refresh' => 30,
				'height' => '300px',
				'width' => '100%',
			],
		]
	]);

@endphp

@section('content')
	{{-- In case widgets have been added to a 'content' group, show those widgets. --}}
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('group', 'content')->toArray() ])
@endsection