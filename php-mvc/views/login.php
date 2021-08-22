<?php
    /**
     * @var $model \app\models\User
     */
    use app\core\form\Form;

    /** @var $this app\core\view  **/
    $this->title = 'Login';
?>
<!-- Features section-->
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0">This is <?php echo $name ?? ''; ?></h2>
            </div>
            <div class="col-lg-8 mb-7 mb-lg-0">

                <?php $form = Form::begin( '', 'POST' )?>
                <?php echo $form->field( $model, 'email' ); ?>
                <?php echo $form->field( $model, 'password' )->passwordField(); ?>
                <button type="submit" class="btn btn-primary">Register</button>
                <?php echo Form::end(); ?>


            </div>
        </div>
    </div>
</section>