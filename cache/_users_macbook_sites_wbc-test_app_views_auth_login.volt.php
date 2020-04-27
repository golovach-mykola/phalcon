<section>
    <form method="post" action="" class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
        <?= $this->flash->output() ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <?= $form->render('email') ?>
          </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <?= $form->render('password') ?>
        </div>

        <p><?= $this->tag->submitButton(['Login', 'class' => 'btn btn-primary']) ?></p>
    </form>
</section