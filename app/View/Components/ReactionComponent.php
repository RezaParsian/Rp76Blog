<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReactionComponent extends Component
{
	public string $article;
	public $meta;

	/**
	 * Create a new component instance.
	 *
	 * @return void
	 */
	public function __construct($article,$meta)
	{
		$this->article = $article;
		$this->meta = $meta;
	}

	/**
	 * @return Application|Factory|Htmlable|View
	 */
	public function render()
	{
		return view('components.reaction-component');
	}
}
