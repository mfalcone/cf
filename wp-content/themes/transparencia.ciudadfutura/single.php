<? get_header() ?>

  <? if ( have_posts() ) : the_post() ?>

    <article class="article" itemscope="" itemtype="http://schema.org/BlogPosting" role="article">

      <h1 class="article_title" itemprop="name"><? the_title(); ?></h1>

     
      <section class="article_content" itemprop="description">
      	<? the_content(); ?>
      </section>

    </article>

  <? endif ?>

<? get_sidebar() ?>
<? get_footer() ?>
