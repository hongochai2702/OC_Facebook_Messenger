<?php echo $header; ?><?php echo $column_left; ?>

<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-account" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
        <button id="save_ajax" data-toggle="tooltip" title="<?php echo 'Lưu nhanh'; ?>" class="btn btn-success"><i class="fa fa-save"></i> <?php echo 'Lưu nhanh'; ?></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-danger"><i class="fa fa-reply"></i> <?php echo $button_cancel; ?></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div id="debugs"></div>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-account" class="form-horizontal">
          <!-- Enabled / Disabled -->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="fb_messenger_status" id="input-status" class="form-control">
                <?php if ($fb_messenger_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <!-- Nav_TAB -->
          <ul class="nav nav-tabs">
            <li class="active">
              <a href="#tab-fb-chat" data-toggle="tab"><?php echo $entry_tab_fb_chat; ?></a>
            </li>

            <li>
              <a href="#tab-fb-messenger" data-toggle="tab"><?php echo $entry_tab_fb_messenger; ?></a>
            </li>
          </ul>
          <!-- Tab_CONTENT -->
          <div class="tab-content">
            <div class="tab-pane active" id="tab-fb-chat">
                
                <div class="form-group">
                  <label for="input-fb-messenger-user" class="col-sm-2 control-label"><?php echo $entry_fb_messenger_user; ?></label>
                  <div class="input-group col-sm-10" style="padding-left: 15px; padding-right: 15px;">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-facebook"></i> Fanpage</span>
                    <input type="text" class="form-control" placeholder="<?php echo $entry_fb_messenger_user; ?>" name="fb_messenger_user" id="input-fb-messenger-user" aria-describedby="basic-addon1" value="<?php echo $fb_messenger_user; ?>" />
                  </div>
                </div>
                <!-- /#input-fb-messenger-user -->

                <div class="form-group">
                  <label for="input-fb-messenger-postion" class="col-sm-2 control-label"><?php echo $entry_fb_messenger_postion; ?></label>
                  <div class="col-sm-10">
                    <input type="checkbox" class="form-control" name="fb_messenger_postion" id="input-fb-messenger-postion"  <?php echo ('on' == $fb_messenger_postion) ? 'checked' : ''; ?> data-on-text="Phải" data-off-text="Trái" data-on-color="success" data-off-color="warning" />
                    <script type="text/javascript">
                      $("#input-fb-messenger-postion").bootstrapSwitch();
                    </script>
                  </div>
                </div>
                <!-- /#input-fb-messenger-postion -->

                <div class="form-group">
                  <label for="select-fb-messenger-display" class="col-sm-2 control-label"><?php echo $entry_fb_messenger_display; ?></label>
                  <div class="col-sm-10">
                    <select class="form-control" name="fb_messenger_display" id="select-fb-messenger-display">
						<?php foreach ( $fb_messenger_display_text as $key => $val ) : ?>
                          <?php if ( (int) $fb_messenger_display == $key ) : ?>
                            <option value="<?php echo $key; ?>" selected="selected"><?php echo $val; ?></option>
                          <?php else : ?>
                            <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                          <?php endif; ?>      
                        <?php endforeach; ?>
                      
                    </select>
                  </div>
                </div>
                <!-- /#input-fb-messenger-user -->



            </div> 
            <!-- /#tab-fb-chat -->
            <div class="tab-pane" id="tab-fb-messenger">
              <h2>FB MESSENGER</h2>
            </div>
            <!-- /#tab-fb-messenger -->
          </div>
          <!-- /.tab-content -->
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
<style type="text/css">
  #save_ajax {
    background-color: #4b8643;
    border-color: #4b8643;
  }
</style>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#save_ajax').click(function(event) {
      var token = $('#form-account').attr('action');
      var datas = {
        fb_messenger_user: $("#input-fb-messenger-user").val(),
      };
      $.ajax({
          url: token,
          type: 'POST',
          data: datas,
          beforeSend: function() {
            $('#form-account').fadeTo('slow', 0.5);
          },

          complete: function() {
            $('#form-account').fadeTo('slow', 1);
          },
          success: function() {
            //$('.alert').remove();
            //console.log(json);
            $('#debugs').prepend('<div class="alert alert-success"><i class="fa fa-save"></i> ' + 'Lưu thành công.' + '</div>')
          }
      });
    });
  });
</script>