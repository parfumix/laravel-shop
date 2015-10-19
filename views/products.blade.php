@extends('themes::layouts.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        {!! Widget::render() !!}
        <!-- Your Page Content Here -->

        {!! $table->render() !!}
    </section><!-- /.content -->
@endsection