jQuery(document).ready(function($){

    function update_shortcode_examples()
    {
        var sel = $( '#iewp-content-snippets-select select' );
        var id = sel.val();
        var title = sel.find( ':selected' ).data( 'title' );
        $( '#iewp-content-snippets-example-one' ).html( id );
        $( '#iewp-content-snippets-example-two' ).html( title );
    }

    update_shortcode_examples();

    $( document ).on( 'change keyup', '#iewp-content-snippets-select select', function()
    {
        update_shortcode_examples();
    });

});
