<?php

        global $stud, $subj, $schl, $level, $art;

        $student = $stud->get_student( $_SESSION['s_m_s_i'] );

        $school     = $schl->get_student_school( $_SESSION['s_m_s_i'] );
        $f_level    = $level->get_student_level( $_SESSION['s_m_s_i'] );


?>

<link href="public/css/profile.css" rel="stylesheet">

<style type="text/css">
    .small-nav-handle, .navbar-toggle, .fa-ellipsis-v{
        display: none;
    }
</style>

<section id="blog" class="blog">

    <div class="container" data-aos="fade-up">

        <div class="row profile">

            <div class="col-md-3">

                <div class="profile-sidebar">
                    

                    <div class="profile-userpic">
                        <img src="public/images/forum.png" class="img-responsive" alt="">
                    </div>
                    
                    <div class="profile-usertitle">

                        <div class="profile-usertitle-name">
                            <?= $school->name ?>
                        </div>

                        <div class="profile-usertitle-job">
                            <?= $f_level->name ?>
                        </div>
                    
                    </div>
                    
                    <div class="profile-usermenu">

                        <ul class="nav">
                            <li>
                                <a class="nav-item nav-link" href="index.php?view=forum">
                                    <i class="bi bi-card-checklist"></i>
                                    Overview 
                                </a>
                            </li>

                            <li>
                                <a class="nav-item nav-link" href="index.php?view=teachers">
                                    <i class="bi bi-person-square"></i>
                                    Teachers 
                                </a>
                            </li>
                        
                        </ul>
                    
                    </div>
                    <!-- END MENU -->
                
                </div>

            </div>

            <div class="col-md-9">

                <div class="profile-content">
                            
                    <center><?php check_message(); ?></center>


                    <div class="row">

                        <div class="col-lg-8 entries">

                            <article class="entry">

                                <div class="entry-img">
                                    <img src="assets/img/blog/blog-1.jpg" alt="" class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                <a href="blog-single.html">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center">
                                            <i class="bi bi-person"></i> 
                                            <a href="blog-single.html">John Doe</a>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="bi bi-clock"></i> 
                                            <a href="blog-single.html">
                                                <time datetime="2020-01-01">Jan 1, 2020</time>
                                            </a>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="bi bi-chat-dots"></i> 
                                            <a href="blog-single.html">12 Comments</a>
                                        </li>
                                    </ul>
                                
                                </div>

                                <div class="entry-content">
                                    <p>
                                        Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
                                        Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.
                                    </p>
                                    <div class="read-more">
                                        <a href="blog-single.html">Read More</a>
                                    </div>

                                </div>

                            </article><!-- End blog entry -->

                            <div class="blog-pagination">
                                <ul class="justify-content-center">
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                </ul>
                            </div>

                        </div><!-- End blog entries list -->

                        <div class="col-lg-4">

                            <div class="sidebar">

                                <h3 class="sidebar-title">Search</h3>

                                <div class="sidebar-item search-form">
                                    <form action="">
                                        <input type="text">
                                        <button type="submit"><i class="bi bi-search"></i></button>
                                    </form>
                                </div><!-- End sidebar search formn-->

                                <h3 class="sidebar-title">Categories</h3>

                                <div class="sidebar-item categories">

                                    <ul>

                                        <?php $art->get_top_categories() ?>

                                    </ul>

                                </div><!-- End sidebar categories-->

                                <h3 class="sidebar-title">Recent Posts</h3>

                                <div class="sidebar-item recent-posts">

                                    <?php $art->get_latest_articles() ?>

                                </div><!-- End sidebar recent posts-->

                                <h3 class="sidebar-title">Tags</h3>

                                <div class="sidebar-item tags">

                                    <ul>
                                        
                                        <?php $art->get_top_tags(); ?>
                                        
                                    </ul>

                                </div><!-- End sidebar tags-->

                            </div><!-- End sidebar -->

                        </div><!-- End blog sidebar -->

                    </div>
                            
                </div>
            
            </div>
        
        </div>

    </div>

</section>

