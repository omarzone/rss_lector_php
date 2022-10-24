<?php
require_once('libs/SimplePie.compiled.php');
require_once('libs/simple_html_dom.php');

$feed = new SimplePie();

$feed->set_feed_url('http://feeds.weblogssl.com/xataka2');

$feed->enable_cache(true);
$feed->set_cache_location('cache');
$feed->set_cache_duration(1800);

$feed->init();

$feed->handle_content_type();


$item = $feed->get_items();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Rss</title>
</head>

<body>
    <div class="container">
        <h1>Ultimas noticias</h1>




        <?php
        $itemQty = $feed->get_item_quantity();

        for ($i = 0; $i < $itemQty; $i++) {

            $post = new simple_html_dom();
            $post->load($item[$i]->get_description());
        ?>


            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= $post->find('img', 0)->src; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item[$i]->get_title() ?></h5>
                            <p class="card-text"><?= $post->find('p', 1); ?></p>
                            <p class="card-text"><small class="text-muted"><?= $item[$i]->get_author()->get_name() ?></small></p>
                            <button href="#" class="btn btn-primary stretched-link" data-bs-toggle="modal" data-bs-target="#modal<?= $i ?>">Leer más</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal modal-fullscreen fade " id="modal<?= $i ?>" tabindex="-1" aria-labelledby="modalLabel<?= $i ?>" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel<?= $i ?>"><?= $item[$i]->get_title() ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= $item[$i]->get_description() ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>







</body>
<script src="js/main.js"></script>

</html>