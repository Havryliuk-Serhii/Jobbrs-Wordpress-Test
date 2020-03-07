<?php get_header(); ?>
<article class="content">
  <section class="post">
    <h2 class="post-title">Lorem ipsum dolor sit amet,consectetur adipiscing elit,sed do eiusmod tempor</h2>
    <span class="author">Admin</span>
    <img src="./img/8.jpg" class="card-img col-md-12 col-lg-6" alt="post image">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
       incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
       exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
       irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
       Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <a href="<?php the_permalink(); ?>" class="btn-post">Далее</a>
  </section>
  <section class="page-pagination">
                <h3 class="title-hidden">Pagination</h3>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                            </li>
                        </ul>
                    </nav>
                </section>
<?php jobbrs_pagination(); ?>

</article>
<?php get_sidebar();
      get_footer();
 ?>