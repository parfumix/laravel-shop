@extends('themes::layouts.default')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->

        <div class="row">

            {!! Widget::render() !!}

            <div class="col-xs-12">

                <div class="box">
                    {!! Parfumix\TableManager\render_filter_form($table) !!}
                </div>

                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        {!! $table->render() !!}
                        {!! Parfumix\TableManager\render_pagination($table, null, ['scope' => request('scope')]) !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

        </div>
        <!-- /.row -->

    </section><!-- /.content -->
@endsection