
// metisMenu Sidebar Script
$(function() {

    $('#side-menu').metisMenu();

});
//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});



/*Clickable Panel Heading Script*/

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    }
});


// Bootstrap popover 
$(function () {
  $('[data-toggle="popover"]').popover()
});



/* $(function () {
    $('.datetimepicker').datetimepicker({format: 'YYYY/MM/DD'});
});*/


$('.datetimepicker').datetimepicker({
    dateFormat: 'yy-mm-dd'
});


// Chosen Multiple Select input box
var config = {
              '.chosen-select'           : {},
              '.chosen-select-deselect'  : {allow_single_deselect:true},
              '.chosen-select-no-single' : {disable_search_threshold:10},
              '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
              '.chosen-select-width'     : {width:"95%"}
            }
            for (var selector in config) {
              $(selector).chosen(config[selector]);
            };


// Bootstrap DataTable 
 $(document).ready(function() {
    $('#dataTables-example1').DataTable();
    $('#dataTables-example2').DataTable();
    $('#dataTables-example3').DataTable();
    
} );

// jQuery Multifield
//$('#example-1').multifield();


// Bootstrap table row clickable
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});


// TreeGrid jQuery
$('.tree').treegrid();
 // $(document).ready(function() {
 //        $('.tree').treegrid({
 //                    expanderExpandedClass: 'glyphicon glyphicon-minus',
 //                    expanderCollapsedClass: 'glyphicon glyphicon-plus'
 //                });
 //    });


 // Dropdown auto select for page to page

 function redirectPage(value)
{
 window.location.href = value;
};

$(document).on('click', '.btn-add', function (e)
{
    e.preventDefault();
    
    var controlForm = $('#user_role1'),
    currentEntry = $(this).parents('.user_list1:first'),
    newEntry = $(currentEntry.clone()).appendTo(controlForm);
    console.log(currentEntry);
    newEntry.find('.bootstrap-select').replaceWith(function() { return $('select', this); });
    $('.selectpicker').selectpicker('refresh');
    newEntry.find('input').val('');
    controlForm.find('.user_list1:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
}).on('click', '.btn-remove', function (e)
{
    $(this).parents('.user_list1:first').remove();
    e.preventDefault();
    return false;
});

 
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.delete_confirm').on('click', function (e) {
        var id = $(this).data('id');
        var delete_url = $(this).attr('href');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this info again",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            
        },
        function(isConfirm) {
            //alert(isConfirm);
            //return true;
            if (isConfirm) {
                $.ajax({
                    url: delete_url,
                    type: "DELETE",
                    data: {id: id},
                    success: function(result){

                        $("tr[row_id='"+id+"']").remove();
                    }
                })
//                swal({
//                    title: 'Deleted',
//                    text: 'User has successfully deleted',
//                    type: 'success'
//                }, function() {
//                    
//                });

            } 
        });
        //return confirm('Are you sure?');
    });

