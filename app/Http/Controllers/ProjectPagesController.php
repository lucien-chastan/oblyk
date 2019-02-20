<?php

namespace App\Http\Controllers;

use App\Help;

class ProjectPagesController extends Controller
{
    public function projectPage()
    {
        return view('pages.project.project');
    }

    public function whoPage()
    {
        return redirect(route('project'), 301);
    }

    public function contactPage()
    {
        return view('pages.project.contact');
    }

    public function aboutPage()
    {
        return view('pages.project.about');
    }

    public function gradePage()
    {
        return view('pages.project.grade');
    }

    public function helpPage()
    {
        $helpCategory = [];
        $helps = Help::orderBy('category')->get();
        foreach ($helps as $help) $helpCategory[$help->category][] = $help;

        $data = [
            'meta_title' => 'Aide',
            'helpCategory' => $helpCategory
        ];

        return view('pages.project.help', $data);
    }

    public function supportUsPage()
    {
        return view('pages.project.supportUs');
    }

    public function thanksPage()
    {
        return view('pages.project.thanks');
    }

    public function developerPage()
    {
        return view('pages.project.developer');
    }

    public function termsOfUsePage()
    {
        return view('pages.project.termsOfUse');
    }

    public function indoorPage()
    {
        return view('pages.project.indoorPresentation');
    }
}
