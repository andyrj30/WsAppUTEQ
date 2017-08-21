@extends( 'layouts.master' )

@section( 'content' )
<div id="homepage" class="clear">
    <div class="two_third" style="width: 100%; ">
        <section class="clear" style="margin: 15px">

            <?php
            if ($this->titulo != null) {
                echo '<h2 style="border-bottom: 5px solid #FF9900; color:#3D8E33;">'. $this->titulo .'</h2>';
            }
            ?>
            {!! $this->result !!}
        </section>
    </div>
</div>
@stop
