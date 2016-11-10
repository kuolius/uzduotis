<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    </head>
    <body>
        <?php echo form_open('/home/update_task',array('class'=>'form-horizontal')); ?>
        
        <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-8">
        <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?php echo $description; ?>">
        </div>
        </div>
        <input type="hidden" name="page" value="<?php echo $page;?>"/>
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <div class="col-sm-offset-2">
            <input type="submit" name="submit" class="btn btn-default" value="Update" />
        </div>
        <?php echo form_close(); ?>
    </body>
    <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</html>
