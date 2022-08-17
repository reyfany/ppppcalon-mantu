@extends('errors::minimal')

@section('title', __('MARKETPLACE || Cart'))
@section('code', )
@section('message', __($exception->getMessage() ?: 'Forbidden'))