<?php namespace App;
use Illuminate\Routing\Controller;

class Actions extends Controller{
    public static function returnBack($msj,$style)
    {
        return \Redirect()->back()->with('message',$msj)
            ->with('alert',$style);
    }

    public static function canSeeMenu($object)
    {
        if((\Auth::user()->hasAccess($object.'.all'))|| (\Auth::user()->hasAccess($object.'.see'))) {
            return true;
        }
        return false;
    }

}
