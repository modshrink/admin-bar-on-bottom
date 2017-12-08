(function(win, doc) {
    'use strict';

    if ( 'querySelector' in doc && 'addEventListener' in win )
    {
        doc.addEventListener( 'DOMContentLoaded', function()
        {
            var bar = doc.getElementById( 'wpadminbar' );

            doc.addEventListener( 'keypress', function( e )
            {
                if( e.shiftKey === true && e.which === 65 )
                {
                    bar.classList.toggle( 'is-hidden' );
                }
            });
        });
    }

})(window, document);