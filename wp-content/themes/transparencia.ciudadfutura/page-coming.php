<?php /* Template Name:Coming */  ?>
<!DOCTYPE html>
<html>
<head>
    <title>Cuentas Claras</title>
   <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/coming.css">
   <!-- for Facebook -->          
<meta property="og:title" content="Presentación Pública Cuentas Claras" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/img/banner_web_portal_transp.png" />
<meta property="og:url" content="<?php echo get_permalink(); ?>" />
<meta property="og:description" content="A través de esta web cualquier ciudadano podrá ver en cualquier momento las definiciones económicas y políticas que le dan vida a Ciudad Futura." />
</head>
<body>

<script type="text/javascript">
var end = new Date('07/26/2016 10:00 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('dias').innerHTML = days;
        document.getElementById('horas').innerHTML = hours;
        document.getElementById('minutos').innerHTML = minutes;
        document.getElementById('segundos').innerHTML = seconds;
    }

    timer = setInterval(showRemaining, 1000);
</script>

<?php if ( have_posts() ) : 
            // Do we have any posts in the databse that match our query?
            ?>

                <?php while ( have_posts() ) : the_post(); 
                // If we have a post to show, start a loop that will display it
                ?>
                <div class="wrap" style="width:50%;margin-left: auto;margin-right: auto;margin-bottom:20px;">
                 <div style="position: relative; padding-bottom: 56.25%; height: 0;"><iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/kedrLWxVX8c" width="100%" height="150" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
                </div>
                <img src="<?php bloginfo('template_directory'); ?>/img/icon.png" alt="isologo Ciudad Futura">
                
                <div class="container">

                        <div class="main-texto">


                                <h1>
                                    <?php the_title(); ?>
                                </h1>
                                <?php the_content(); ?>
                        </div>
                </div>
                
                <?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
        
            <?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
                
                <article class="post error">
                    <h1 class="404">No hay nada</h1>
                </article>

            <?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
<div class="main-texto">
            <p class="estara">La web estará online en:</p>

<div class="count-wrap"><div id="dias" class="count"></div><p>Dias</p></div>
<div class="count-wrap"><div id="horas" class="count"></div><p>Horas</p></div>
<div class="count-wrap"><div id="minutos" class="count"></div><p>Minutos</p></div>
<div class="count-wrap"><div id="segundos" class="count"></div><p>segundos</p></div>
</div>

</body>
</html>
