jQuery(document).ready(function($) {
    'use strict';
    $('body').on('click', '.brochure_img', function(e) {
        e.preventDefault();
        var button = $(this),
            custom_uploader = wp.media({
                library: {
                    type: 'image'
                },
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<p><img class="true_pre_image" src="' + attachment.url + '" style="max-width:350px" /></p>').next().val(attachment.id).next().show()
            }).open()
    });
    $('body').on('click', '.brochure_img_remove', function() {
        $(this).hide().prev().val('').prev().addClass('button').html('Upload Image');
        return !1
    });
    $('.brochure_img_remove').on('click', function(e) {
        $('.brochure_img_display').hide()
    });
    $('.brochure_img').on('click', function(e) {
        $('.brochure_img_display').hide()
    });
    $('.brochure_img').on('click', function(e) {
        $('.brochure_img_msg').hide()
    });
    $('.brochure_img_remove').on('click', function(e) {
        $('.brochure_img_msg').show()
    });
    $('body').on('click', '.icon_img', function(e) {
        e.preventDefault();
        var button = $(this),
            custom_uploader = wp.media({
                library: {
                    type: 'image'
                },
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<p><img class="true_pre_image" src="' + attachment.url + '" style="max-width:350px" /></p>').next().val(attachment.id).next().show()
            }).open()
    });
    $('body').on('click', '.icon_img_remove', function() {
        $(this).hide().prev().val('').prev().addClass('button').html('Upload Image');
        return !1
    });
    $('.icon_img_remove').on('click', function(e) {
        $('.icon_img_display').hide()
    });
    $('.icon_img').on('click', function(e) {
        $('.icon_img_display').hide()
    });
    $('.icon_img').on('click', function(e) {
        $('.icon_img_msg').hide()
    });
    $('.icon_img_remove').on('click', function(e) {
        $('.icon_img_msg').show()
    });
    $('body').on('click', '.brochure_file', function(e) {
        e.preventDefault();
        var button = $(this),
            custom_uploader = wp.media({}).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $(button).removeClass('button').html('<h4 class="pdf_file" style="display:block;" >' + attachment.filename + '</h4>').next().val(attachment.id).next().show()
            }).open()
    });
    $('body').on('click', '.brochure_file_remove', function() {
        $(this).hide().prev().val('').prev().addClass('button').html('Upload File');
        return !1
    });
    $('.brochure_file_remove').on('click', function(e) {
        $('.brochure_file_display').hide()
    });
    $('.brochure_file').on('click', function(e) {
        $('.brochure_file_display').hide()
    });
    $('.brochure_file').on('click', function(e) {
        $('.brochure_file_msg').hide()
    });
    $('.brochure_file_remove').on('click', function(e) {
        $('.brochure_file_msg').show()
    })
});