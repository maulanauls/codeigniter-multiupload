//-- function angkatan --//
function bttn_remove_angkatan_field(id) {
    var scntDiv = $('#angkatan-form');

        var i = id;

            $('#angkatan-form #field_'+id+'').remove();

        i--;

    return false;
}
function bttn_adding_angkatan_field() {

var scntDiv = $('#angkatan-form');

var i = 1 + $('#angkatan-form .toclone').size();

  $('<div id="field_'+i+'" class="toclone"><div class="form-group"><label class="control-label col-md-3">nama depan alumni*</label><div class="col-md-9"><input class="form-control" placeholder="nama depan alumni" name="firstname['+i+']" value=""/><span id="firstname_'+i+'" class="help-block"></span></div></div><div class="form-group"><label class="control-label col-md-3">nama belakang alumni*</label><div class="col-md-9"><input class="form-control" placeholder="nama belakang alumni" name="lastname['+i+']" value=""/><span id="lastname_'+i+'" class="help-block"></span></div></div><div class="form-group"><label class="control-label col-md-3">email**</label><div class="col-md-9"><input placeholder="contoh : mnwnbk@gmail.com" name="email['+i+']" class="form-control"/><span id="email_'+i+'" class="help-block"></span></div></div><div class="form-group"><label class="control-label col-md-3">website**</label><div class="col-md-9"><input placeholder="contoh : https://www.instgram.com/nama alumni" name="website['+i+']" class="form-control"/><span id="website_'+i+'" class="help-block"></span></div></div><div class="form-group"><label class="control-label col-md-3">no telp/handphone**</label><div class="col-md-9"><input placeholder="contoh : +6287778784550" name="phone['+i+']" class="form-control"/><span id="phone_'+i+'" class="help-block"></span></div></div><div class="form-group"><label class="control-label col-md-3">angkatan ke**</label><div class="col-md-9"><select name="angkatan['+i+']" class="form-control"><option value="angkatan_1">Angkatan ke 1</option><option value="angkatan_2">Angkatan ke 2</option></select><span id="angkatan_'+i+'" class="help-block"></span></div></div><div class="form-group"><label class="control-label col-md-3">biography**</label><div class="col-md-9"><textarea placeholder="deskripsi alumni" name="biography['+i+']" class="form-control"></textarea><span id="biography_'+i+'" class="help-block"></span></div></div><div class="form-group"><label for="fileInputHor" class="col-sm-3 control-label">berkas gambar</label><div class="col-sm-9"><input id="fileInputHor" name="file_image['+i+']" type="file" class="dropify"><span id="file_image_'+i+'" class="help-block"></span></div></div><div class="form-group"><label class="col-sm-3 control-label"></label><div class="col-sm-9"><p>*<i style="color:red;">harus diisi</i>/**<i style="color:red;">sangat di anjurkan diisi</i></p><button type="button" onclick="bttn_adding_angkatan_field()" class="btn btn-outline btn-primary"><i class="ti-plus"></i> tambah field</button>&nbsp;<button type="button" onclick="bttn_remove_angkatan_field('+i+')" class="btn btn-outline btn-primary"><i class="ti-minus"></i> kurangi field</button></div></div></div>').appendTo(scntDiv);

  $('#fileInputHor_'+i+'').dropify({// default file for the file input
        defaultFile: "",
        // max file size allowed
        maxFileSize: 0,
        // custom messages
        messages: {
            'default': 'tarik dan jatuh berkas gambar anda disini',
            'replace': 'tarik dan jatuh berkas gambar anda disini untuk merubah',
            'remove':  'hapus',
            'error':   'oops, terjadi kesalahan.'
        },
        // custom template
        tpl: {
            wrap:        '<div class="dropify-wrapper"></div>',
            message:     '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
            preview:     '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
            filename:    '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
            clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
            error:       '<p class="dropify-error">{{ error }}</p>'
        }
    });

    i++;
    return false;

}
function bttn_adding_c_angkatan() {
    save_method = 'add';
                $('#c_angkatan_form')[0].reset(); // reset form on modals
                $('.form-control').removeClass('has-error'); // clear error class
                $('.form-group').removeClass('has-error'); // clear error class
                $('.help-block').removeClass('has-error'); // clear error class
                $('.help-block').empty(); // clear error string
                $('.col-md-9').removeClass('has-error'); // clear error class
                $('.modal-title').text('menambah data alumni'); // Set Title to Bootstrap modal title
                $('[name="website[0]"]').val('');
                $('[name="firstname[0]"]').val('');
                $('[name="lastname[0]"]').val('');
                $('[name="email[0]"]').val('');
                $('[name="phone[0]"]').val('');
                $('[name="biography[0]"]').val('');
                $('#btnSave').html('simpan perubahan'); //change button text
                $('#fileInputHor').dropify({// default file for the file input
                    defaultFile: "",
                    // max file size allowed
                    maxFileSize: 0,
                    // custom messages
                    messages: {
                        'default': 'tarik dan jatuh berkas gambar anda disini',
                        'replace': 'tarik dan jatuh berkas gambar anda disini untuk merubah',
                        'remove':  'hapus',
                        'error':   'oops, terjadi kesalahan.'
                    },
                    // custom template
                    tpl: {
                        wrap:        '<div class="dropify-wrapper"></div>',
                        message:     '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
                        preview:     '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
                        filename:    '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                        clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
                        error:       '<p class="dropify-error">{{ error }}</p>'
                    }
                });
                $('#modalform').modal('show'); // show bootstrap modal
}

function bttn_save_c_angkatan() {
  $('#c_angkatan_form').ajaxForm({
      url: url + 'add',
      dataType: 'json',
      beforeSerialize: function() {},
      beforeSubmit: function() {
          $('#btnSave').text('menyimpan...'); //change button text
          $('#btnSave').attr('disabled', true); //set button disable
      },
      success: function(data) {
          if (data.status) //if success close modal and reload ajax table
          {
              $('#modalform').modal('hide'); // show bootstrap modal when complete loader
              toastr.options = {
                  closeButton: true,
                  progressBar: true,
                  showMethod: 'fadeIn',
                  hideMethod: 'fadeOut',
                  timeOut: 8000
              };
              toastr.success('berhasil, menyimpan data', 'system says,');
              location.reload();
          } else {
              for (var i = 0; i < data.inputerror.length; i++) {
                $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                $('#'+data.error_id[i]+'').text(data.error_string[i]);
              }
          }
          $('#btnSave').html('save changes'); //change button text
          $('#btnSave').attr('disabled', false); //set button enable
      },
      error: function(jqXHR, textStatus, errorThrown) {
          toastr.options = {
              closeButton: true,
              progressBar: true,
              showMethod: 'fadeIn',
              hideMethod: 'fadeOut',
              timeOut: 8000
          };
          toastr.error('terjadi kesalahan, tidak bisa menyimpan data', 'system says,');
          $('#btnSave').html('save changes'); //change button text
          $('#btnSave').attr('disabled', false); //set button enable
      }
  });
}
