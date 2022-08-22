<div class="container-fluid bread breadcrumb  my-2 px-5">
    <div class="row">
        <style>
            .bread ul li {
                padding-right: 0.5rem;
            }
        </style>

        <ul class="list-unstyled d-flex">
            <li><a href="teacher_section.php"><i class="fas fa-home"></i></a> </li>
            <li> /
                <?php if (empty($_GET['sem'])) { ?>
                    Semester
                <?php } else { ?>
                    <?php echo $_GET['sem']?>  Semester

                    <?php } ?>
            </li>
            <li class="not_in_Homepage text-capitalize"> / <?=$basename?> </li>
        </ul>

        <!-- <?= $url ?> -->

    </div>
</div>