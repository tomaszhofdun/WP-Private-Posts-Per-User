<?php
get_header();

$user = wp_get_current_user();
$display_name = $user->display_name;
$user_email = $user->user_email;
?>

<div class="pppu-tabs">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Profil</a></li>
        <li role="presentation"><a href="#fees"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Opłaty</a></li>
        <li role="presentation"><a href="#messages"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Wiadomości</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <?php
            // the_content();  
            ?>
            <p>Witaj <?php echo $display_name ?></p>
            <p>Twój email: <?php echo $user_email ?></p>
            <!-- <p>Zarejestrowany dnia: </p> -->
        </div>

        <div role="tabpanel" class="tab-pane bg-danger" id="fees">
            <?php the_field('oplaty') ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
            <?php the_field('wiadomosci') ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>