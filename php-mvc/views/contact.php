<?php
    /** @var $this app\core\view  **/
    /**
     * @var $model \app\models\ContactForm;
     */

    $this->title = 'Contact';

    use app\core\form\TextArea;
?>
<!-- Features section-->
<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0">This is <?php echo $name ?? ''; ?></h2>
            </div>
            <div class="col-lg-8 mb-7 mb-lg-0">


                <?php $form = \app\core\form\Form::begin( '', 'post' );?>
                <?php echo $form->field( $model, 'name' ); ?>
                <?php echo $form->field( $model, 'email' ); ?>
                <?php echo $form->field( $model, 'subject' ); ?>
                <?php echo new TextArea( $model, 'body' ); ?>
                <button type="submit" class="btn btn-primary">Submit</button>
                <?php $form = \app\core\form\Form::end();?>


            </div>
        </div>
    </div>
</section>