(function( $ ) {


  // Get the ul for the posts to display
  // Set the URL for your WP API Root jsforwp_globals.rest_url
  var   container = document.getElementById( 'main' ),
        wpRestUrl = __CHANGE__;


  (function init() {

    getPosts();

  })();


  function getPosts() {

    $.ajax({
        type: 'get',
        url: wpRestUrl + 'wp/v2/posts',
        data: {
            per_page: 3
        },
        success: function( response ) {

            container.innerHTML = '';

            for( post of response ) {
                renderPostTitleWithLink( post );
            }

            // Get the links inside of h2 tags
            let links = document.querySelectorAll( 'h2 a' );

            for( link of links ) {
                // Call getPost when the link is clicked
                link.addEventListener( 'click', getPost );
            }

        }
    });

  }

  function getPost( event ) {

      // Ge the id from the link data-id
      let id = event.target.dataset.id;

      // Append the id to the url
      $.ajax({
          type: 'get',
          url: wpRestUrl + 'wp/v2/posts/' + id,
          data: {
              per_page: 3
          },
          success: function( response ) {

              container.innerHTML = '';

              renderFullPost( response );

          }
      });

  }

  function renderPostTitleWithLink( post ) {

    var h2 = document.createElement( 'h2' ),
        markup = '';

    markup += `<a href="#${post.link}" data-id="${post.id}">`;
    markup += post.title.rendered;
    markup += '</a>';

    h2.innerHTML = markup;
    container.appendChild( h2 );


  }


  function renderFullPost( post ) {

      let article = document.createElement('article'),
          markup = '';

      article.classList.add( 'post' );

      markup += '<p><a class="backlink" href="#">Go Back</a></p>';
      markup += `<h1>${post.title.rendered}</h1>`;
      markup += `<div class="entry-content">${post.content.rendered}</div>`;

      article.innerHTML = markup;

      article.querySelector( 'a.backlink' ).addEventListener( 'click', getPosts );

      container.appendChild( article );

  }

})( jQuery );
