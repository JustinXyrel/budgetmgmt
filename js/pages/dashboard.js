/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

  "use strict";

  //Make the dashboard widgets sortable Using jquery UI
  $(".connectedSortable").sortable({
    placeholder: "sort-highlight",
    connectWith: ".connectedSortable",
    handle: ".box-header, .nav-tabs",
    forcePlaceholderSize: true,
    zIndex: 999999
  });
  $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

  //jQuery UI sortable for the todo list
  $(".todo-list").sortable({
    placeholder: "sort-highlight",
    handle: ".handle",
    forcePlaceholderSize: true,
    zIndex: 999999
  });

  //bootstrap WYSIHTML5 - text editor
  $(".textarea").wysihtml5();

  $('.daterange').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function (start, end) {
    window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  });

  /* jQueryKnob */
  $(".knob").knob();

  //jvectormap data
  var visitorsData = {
    "US": 398, //USA
    "SA": 400, //Saudi Arabia
    "CA": 1000, //Canada
    "DE": 500, //Germany
    "FR": 760, //France
    "CN": 300, //China
    "AU": 700, //Australia
    "BR": 600, //Brazil
    "IN": 800, //India
    "GB": 320, //Great Britain
    "RU": 3000 //Russia
  };
  //World map by jvectormap
  $('#world-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: "transparent",
    regionStyle: {
      initial: {
        fill: '#e4e4e4',
        "fill-opacity": 1,
        stroke: 'none',
        "stroke-width": 0,
        "stroke-opacity": 1
      }
    },
    series: {
      regions: [{
          values: visitorsData,
          scale: ["#92c1dc", "#ebf4f9"],
          normalizeFunction: 'polynomial'
        }]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] != "undefined")
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
    }
  });

  //Sparkline charts
  var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
  $('#sparkline-1').sparkline(myvalues, {
    type: 'line',
    lineColor: '#92c1dc',
    fillColor: "#ebf4f9",
    height: '50',
    width: '80'
  });
  myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
  $('#sparkline-2').sparkline(myvalues, {
    type: 'line',
    lineColor: '#92c1dc',
    fillColor: "#ebf4f9",
    height: '50',
    width: '80'
  });
  myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
  $('#sparkline-3').sparkline(myvalues, {
    type: 'line',
    lineColor: '#92c1dc',
    fillColor: "#ebf4f9",
    height: '50',
    width: '80'
  });

  //The Calender
  $("#calendar").datepicker();

  //SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '250px'
  });

  /* Morris.js Charts */
  // Sales chart
  // var area = new Morris.Area({
  //   element: 'revenue-chart',
  //   resize: true,
  //   data: [
  //     {y: '2011 Q1', item1: 2666, item2: 2666},
  //     {y: '2011 Q2', item1: 2778, item2: 2294},
  //     {y: '2011 Q3', item1: 4912, item2: 1969},
  //     {y: '2011 Q4', item1: 3767, item2: 3597},
  //     {y: '2012 Q1', item1: 6810, item2: 1914},
  //     {y: '2012 Q2', item1: 5670, item2: 4293},
  //     {y: '2012 Q3', item1: 4820, item2: 3795},
  //     {y: '2012 Q4', item1: 15073, item2: 5967},
  //     {y: '2013 Q1', item1: 10687, item2: 4460},
  //     {y: '2013 Q2', item1: 8432, item2: 5713}
  //   ],
  //   xkey: 'y',
  //   ykeys: ['item1', 'item2'],
  //   labels: ['Item 1', 'Item 2'],
  //   lineColors: ['#a0d0e0', '#3c8dbc'],
  //   hideHover: 'auto'
  // });
  // var line = new Morris.Line({
  //   element: 'line-chart',
  //   resize: true,
  //   data: [
  //     {y: '2011 Q1', item1: 2666},
  //     {y: '2011 Q2', item1: 2778},
  //     {y: '2011 Q3', item1: 4912},
  //     {y: '2011 Q4', item1: 3767},
  //     {y: '2012 Q1', item1: 6810},
  //     {y: '2012 Q2', item1: 5670},
  //     {y: '2012 Q3', item1: 4820},
  //     {y: '2012 Q4', item1: 15073},
  //     {y: '2013 Q1', item1: 10687},
  //     {y: '2013 Q2', item1: 8432}
  //   ],
  //   xkey: 'y',
  //   ykeys: ['item1'],
  //   labels: ['Item 1'],
  //   lineColors: ['#efefef'],
  //   lineWidth: 2,
  //   hideHover: 'auto',
  //   gridTextColor: "#fff",
  //   gridStrokeWidth: 0.4,
  //   pointSize: 4,
  //   pointStrokeColors: ["#efefef"],
  //   gridLineColor: "#efefef",
  //   gridTextFamily: "Open Sans",
  //   gridTextSize: 10
  // });

  // //Donut Chart
  // var donut = new Morris.Donut({
  //   element: 'sales-chart',
  //   resize: true,
  //   colors: ["#3c8dbc", "#f56954", "#00a65a"],
  //   data: [
  //     {label: "Download Sales", value: 12},
  //     {label: "In-Store Sales", value: 30},
  //     {label: "Mail-Order Sales", value: 20}
  //   ],
  //   hideHover: 'auto'
  // });

  //Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    area.redraw();
    donut.redraw();
    line.redraw();
  });

  /* The todo list plugin */
  $(".todo-list").todolist({
    onCheck: function (ele) {
      window.console.log("The element has been checked");
      return ele;
    },
    onUncheck: function (ele) {
      window.console.log("The element has been unchecked");
      return ele;
    }
  });

    var id = $('table').attr('id');
    $('#'+id).DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true
    });

    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
    })

    $('#myModalEdit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
    })


    $('button#create').click(function(){
      $('#myModal').modal('show');
    });

     $('button[name=btnadd]').click(function(e){
      e.preventDefault();
      var username = $('form[name=form_modal]').find('[name=username]').length;
      var err = 0;

       $('form[name=form_modal]').find('div.error').text('');
        $('form[name=form_modal]').find('input, select').each(function(){
          if($(this).val().length == 0){
            err++;
          }
        })

        if(username > 0){
           var uname =  $('form[name=form_modal]').find('input[name=username]').val();
           $.ajax({
              type: "POST",
              url: 'check_username',
              data: {'username': uname },
              success: function(data){
                console.log(data);

                if(err > 0){
                   $('form[name=form_modal]').find('div.error').append('All fields are required.<br>');
                   $('form[name=form_modal]').find('div.error').show();
                }
                if(data == '1'){
                   $('form[name=form_modal]').find('div.error').show();
                   $('form[name=form_modal]').find('div.error').append("Username already exists.<br>");
                   err++;
                }

                if(parseInt(err) <= 0){
                   $('form[name=form_modal]').submit();
                }
              }
            });
        }else{
         console.log(err);
        
          if(parseInt(err) <= 0){
            $('form[name=form_modal]').submit();
          }else{
            $('form[name=form_modal]').find('div.error').text('All fields are required.');
            $('form[name=form_modal]').find('div.error').show();
          }
       }
       
    });


    $('button[name=btnupdate]').click(function(e){
      e.preventDefault();
      var username = $('form[name=form_edit_modal]').find('[name=username]').length;
      var err = 0;

       $('form[name=form_edit_modal]').find('div.error').text('');
        $('form[name=form_edit_modal]').find('input, select').each(function(){
          if($(this).val().length == 0){
            err++;
          }
        })

        if(username > 0){
           var uname =  $('form[name=form_edit_modal]').find('input[name=username]').val();
           var ref =  $('form[name=form_edit_modal]').find('input[name=ref]').val();

           $.ajax({
              type: "POST",
              url: 'check_username',
              data: {'username': uname ,'id': ref },
              success: function(data){
                console.log(data);

                if(err > 0){
                   $('form[name=form_edit_modal]').find('div.error').append('All fields are required.<br>');
                   $('form[name=form_edit_modal]').find('div.error').show();
                }
                if(data == '1'){
                   $('form[name=form_edit_modal]').find('div.error').show();
                   $('form[name=form_edit_modal]').find('div.error').append("Username already exists.<br>");
                   err++;
                }

                if(parseInt(err) <= 0){
                   $('form[name=form_edit_modal]').submit();
                }
              }
            });
        }else{
        
          if(parseInt(err) <= 0){
            $('form[name=form_edit_modal]').submit();
          }else{
            $('form[name=form_edit_modal]').find('div.error').text('All fields are required.');
            $('form[name=form_edit_modal]').find('div.error').show();
          }
       }
       
    });


    //  $('button[name=btnupdate]').click(function(){
    //     $('form[name=form_edit_modal]').submit();
       
    // });

    $('button[name=btnprojadd]').click(function(){
        
        if($('div.user_list').length == 0){
          $('div.error').text('Please add personnel to save the project.');
          $('div.error').show();
        }else{
          $('form[name=form_modal]').submit();
        }
       
    });



       $('button#remove').click(function(){
          var web = $(this).parents('tr').attr('ref');
          var processs = $('table').attr('name');
          var cur_page =  $('input[name=current_page]').val();

          var conf = confirm("Are you sure you want to remove this record?");
          if(conf){
             $.ajax({
              type: "POST",
              url: 'remove',
              data: {'ref': web , 'process': processs,'current_page': cur_page},
              success: function(data){
                    var  hrf =  window.location.href;
                    window.location.href = hrf+'?s=3'; 
              }
            });
          }
       })

    $('button#edit').click(function(){
        var val = $(this).parents().children('td').first().text();
        var web = $(this).parents('tr').attr('ref');
        var cur_page =  $('input[name=current_page]').val();

         $('#myModalEdit').modal('show');
          $('form[name=form_edit_modal] input,select,textarea').each(function(i,e){
            var n = $(this).attr('name');
            if($(this).attr('type') != 'hidden'){
              var v = $('tr[ref='+web+']').find('td[name='+n+']').text();

              if(n != 'role' && n != 'sponsor_id'){
               $(this).val(v);
              }else if( n =='role'){
                if(v =='Project Member'){
                  $(this).val('3');
                }else{
                  $(this).val('2');
                }
             }else if(n == 'sponsor_id'){
              console.log(v);
              console.log($(this));
                $(this).val($('tr[ref='+web+']').find('td[name='+n+']').attr('ref'));
             }   
            }
           // console.log(e.attr('type'));
          })
       //  $('form[name=form_edit_modal]').find('input[name=name]').val(val);
         $('form[name=form_edit_modal]').find('input[name=ref]').val(web);

      })

      $('button#proj_man_edit').click(function(){
        var val = $(this).parents().children('td').first().text();
        var web = $(this).parents('tr').attr('ref');
        var cur_page =  $('input[name=current_page]').val();
        var members = $(this).parents('tr').find('input[name=assigned]').val();
        var personnel = JSON.parse(members);

        $('.user_list').remove();
        $.each(personnel,function(i,e){
            var role = (e['user_role'] == 'Project Leader') ? 'Leader' : 'Member';
           $('form[name=form_edit_modal]').append("<div class='user_list' id="+e['user_id']+" exists='1'>"+role+' : '+e['name']+"<button type='button' id='usere_remove'><i class='fa fa-remove'></i></button></div>");

        });

         $('#myModalEdit').modal('show');
          $('form[name=form_edit_modal] input').each(function(i,e){
            var n = $(this).attr('name');
            if($(this).attr('type') != 'hidden'){
              var v = $('tr[ref='+web+']').find('td[name='+n+']').text();
               $(this).val(v);
            }
           // console.log(e.attr('type'));
          })
       //  $('form[name=form_edit_modal]').find('input[name=name]').val(val);
         $('form[name=form_edit_modal]').find('input[name=project_id]').val(web);


      })

    if($('div.success').length > 0){
      if($('div.success').css('display') == 'block'){
        setTimeout(function(){
          $('div.success').fadeOut();
        },3000);
      }
    }


    $('button#add_personnel').click(function(){
      var user_id = $(this).parents('form').find('select[name=user]').val();
      var user_name =  $(this).parents('form').find('select[name=user] option:selected').text();
      var user_role =  $(this).parents('form').find('select[name=user] option:selected').attr('role');
      console.log(user_name);
      if($(this).closest('form').find('div#'+user_id).length == 0){
        $(this).parents('form').append("<div class='user_list' id="+user_id+">"+user_name+"<input type='hidden' name='users[]' value ='"+user_id+"'><input type='hidden' name='role[]' value ='"+user_role+"'><button type='button' id='usern_remove'><i class='fa fa-remove'></i></button></div>");
      }else{
         $('div.error').text('Already added.');
        $('div.error').fadeIn();

        setTimeout(function(){ $('div.error').fadeOut()},2000);

      }
      // $(this).parents('form').append("<input type='hidden' name='users[]' value ='"+user_id+"'>");
      // $(this).parents('form').append("<input type='hidden' name='role[]' value ='"+user_role+"'>");
      // $(this).parents('form').append("<button type='button' id='user_remove'><i class='fa fa-remove'></i></button>");
      // $(this).parents('form').append("</div");

    })

    $(document).on('click','button#usern_remove',function(){
          $(this).parents('div.user_list').remove();
    });

    $(document).on('click','button#usere_remove',function(){
        var web = $('form[name=form_edit_modal]').find('input[name=project_id]').val();
        var processs = $('table').attr('name');
        var cur_page =  $('input[name=current_page]').val();
        var div_id =  $(this).parents('div.user_list').attr('id');
        var exists =  $(this).parents('div.user_list').attr('exists');
        var name = $(this).parents('div.user_list').text();

        var conf = confirm("Are you sure you want to delete "+name+ " from this project?");
console.log(web);
        if(conf){
          if(exists == '1'){
            $.ajax({
              type: "POST",
              url: 'remove_personnel',
              data: {'ref': web , 'process': processs, 'user_id': div_id ,'current_page': cur_page},
              success: function(data){
                console.log(data);
                   $('div.user_list#'+div_id).remove();

              }
            });
          }else{
            $('div.user_list#'+div_id).remove();
          }
        }
    })

    $('select[name=project_id]').change(function(){
      var leaders = JSON.parse($('select[name=project_id]  option:selected').attr('ref'));
      
      $('select[name=project_leader]').find('option').remove();

      $.each(leaders,function(i,e){
        var opts = "<option id="+leaders[i]['user_id']+" value="+leaders[i]['user_id']+">"+leaders[i]['name']+"</option>";
        $('select[name=project_leader]').append(opts);
        

      });
      console.log(leaders[0]['name']);
    });



    $('select[name=b_project_id]').change(function(){
      var sponsors = JSON.parse($('select[name=b_project_id]  option:selected').attr('ref'));
      console.log(sponsors);
      $('select[name=b_project_sponsors]').find('option:gt(0)').remove();
     if( $('select[name=b_project_leader]').length  > 0){

      $('select[name=b_project_leader]').find('option:gt(0)').remove();
    }

      // var opts = "<option id='' value=''></option>";
      $.each(sponsors,function(i,e){
        var opts = "<option id="+i+" value="+i+">"+sponsors[i]+"</option>";
        $('select[name=b_project_sponsors]').append(opts);
        
      });
     // console.log(leaders[0]);
    })

    $('select[name=b_project_sponsors]').change(function(){
      var line_item = JSON.parse($('input[name=list_line_item]').val());
      var project_id =  $('select[name=b_project_id] option:selected').val();
      var grant_list = JSON.parse($('input[name=grant_list]').val());
      var project_sponsor =  $('select[name=b_project_sponsors] option:selected').val();
      console.log(line_item);

      console.log(line_item[project_id][project_sponsor]);
      $('select[name=b_line_item]').find('option:gt(0)').remove();

     if( $('select[name=b_project_leader]').length  > 0){

       $('select[name=b_project_leader]').find('option:gt(0)').remove();
    }

      $.each(line_item[project_id][project_sponsor],function(i,e){
        var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+i+"</option>";
        $('select[name=b_line_item]').append(opts);
      });

       $.each(grant_list[project_sponsor],function(i,e){
        var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+e+"</option>";
        $('select[name=b_grant_list]').append(opts);
      });
    });


    $('select[name=b_line_item]').change(function(){
      var cost= $('select[name=b_line_item] option:selected').attr('avi');
    
      $('input[name=available_budget]').val(cost);
    });

    if( $('select[name=b_project_leader]').length  > 0){
      $('select[name=b_project_sponsors]').change(function(){
        var leader_list = JSON.parse($('input[name=project_leader_list]').val());
        var project_id =  $('select[name=b_project_id] option:selected').val();
        var project_sponsor =  $('select[name=b_project_sponsors] option:selected').val();
        var grant_list = JSON.parse($('input[name=grant_list]').val());

        console.log(project_id);
        console.log(project_sponsor)
        $('select[name=b_line_item]').find('option:gt(0)').remove();


        $.each(leader_list[project_id][project_sponsor],function(i,e){
          var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+e+"</option>";
          $('select[name=b_project_leader]').append(opts);
        });
        console.log(project_sponsor);
        console.log(grant_list);
         $.each(grant_list[project_sponsor],function(i,e){
          var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+e+"</option>";
          $('select[name=b_grant_id]').append(opts);
       });
      });

      $('select[name=b_project_leader]').change(function(){
        var item_list = JSON.parse($('input[name=list_line_item]').val());
        var project_id =  $('select[name=b_project_id] option:selected').val();
        var grant_id =  $('select[name=b_grant_id] option:selected').val();
        var project_sponsor =  $('select[name=b_project_sponsors] option:selected').val();
        var project_leader =  $('select[name=b_project_leader] option:selected').val();

        $('select[name=b_line_item]').find('option:gt(0)').remove();


        $.each(item_list[project_id][project_sponsor][grant_id][project_leader],function(i,e){
          var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+i+"</option>";
          $('select[name=b_line_item]').append(opts);
        });
      });
    }


    $(document).on('change','select[name=b_project_id]',function(){
      var tr =  $(this).parents('tr');

      var sponsors = JSON.parse($(tr).find('select[name=b_project_id]  option:selected').attr('ref'));
      $(tr).find('select[name=b_project_sponsors]').find('option:gt(0)').remove();
      $(tr).find('select[name=b_line_item]').find('option:gt(0)').remove();
      $(tr).find('input[name=available_budget]').val('');
      // var opts = "<option id='' value=''></option>";
      $.each(sponsors,function(i,e){
        var opts = "<option id="+i+" value="+i+">"+sponsors[i]+"</option>";
        $(tr).find('select[name=b_project_sponsors]').append(opts);        
      });
     // console.log(leaders[0]);
    })




    $(document).on('change','select[name=b_project_sponsors]',function(){
      var tr =  $(this).parents('tr');
      var line_item = JSON.parse($(tr).find('input[name=list_line_item]').val());
      var grant_list = JSON.parse($(tr).find('input[name=grant_list]').val());

      var project_id =  $(tr).find('select[name=b_project_id] option:selected').val();
      var project_sponsor =  $(tr).find('select[name=b_project_sponsors] option:selected').val();

      $(tr).find('input[name=available_budget]').val('');

  
      $(tr).find('select[name=b_line_item]').find('option:gt(0)').remove();


      $.each(line_item[project_id][project_sponsor],function(i,e){
        var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+i+"</option>";
        $(tr).find('select[name=b_line_item]').append(opts);
      });

      $.each(grant_list[project_sponsor],function(i,e){
        var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+e+"</option>";
        $(tr).find('select[name=b_grant_list]').append(opts);
      });

      $(tr).find('input[name=project_id]').val(project_id);
      $(tr).find('input[name=project_sponsor]').val(project_sponsor);

    });


    $(document).on('change','select[name=b_line_item]' , function(){
      var tr =  $(this).parents('tr');
      var line_item=  $(tr).find('select[name=b_line_item] option:selected').val();
      var cost= $(tr).find('select[name=b_line_item] option:selected').attr('avi');
      $(tr).find('input[name=line_item]').val(line_item);
      $(tr).find('input[name=available_budget]').val(cost);
    });

    $(document).on('keyup','input[name=cost]' , function(){
      var tr =  $(this).parents('tr');

      $(tr).find('input[name=cost_r]').val($(this).val());
    });

    // $('input[name=request_budget_submit]').click(function(e){
    //     var avail = parseInt($('input[name=available_budget]').val());
    //     var request =  parseInt($('input[name=cost]').val());
    //     $('div.error').text('');
    //     if(avail  < request){
    //       e.preventDefault();
    //       $('div.error').text('Requested budget exceeded available budget.');
    //        $('div.error').show();
    //     }
    // });

     $('input[name=request_budget_submit]').click(function(e){
        var avail = parseInt($('input[name=available_budget]').val());
        var request =  parseInt($('input[name=cost]').val());
        var requests = [];
        var err = 0;

        $('div.error').text('');

        $('select , input[name=cost]').each(function(i,e){
          console.log($(e).val())
           $(e).parents('tr').attr("style","background-color :white;");
          if($(e).val().length == 0){
            $('div.error').text('All fields are required.');
            $('div.error').show();
            $(e).parents('tr').attr("style","background-color :#E4536C;");
            err++;

          }
        });

        $('input[name=available_budget]').each(function(i,e){
           var tr =  $(e).parents('tr');

          var avail = parseInt($(e).val());
          var request =  parseInt($(tr).find('input[name=cost]').val());

           $(e).attr("style","background-color :white;");
          if(avail  < request){
            $('div.error').text('Requested budget exceeded available budget.');
            $('div.error').show();
            $(e).attr("style","background-color :#E4536C;");
            err++;
          }
        });


        $('form').each(function(){
             requests.push($(this).serializeArray());
        })

         console.log(requests);

        if(err == 0){
          $.post('request_budget_db',{'data': requests},function(data){
            console.log(data);
            if(data){
              alert('Successfully requested. You will be redirected to budget request for the status of the requests');
              window.location.href = '/budgetmgmt/users/budget_history';
            }
          });
        }

        
    });


   $('input[name=deduct_budget_submit]').click(function(e){
        var avail = parseInt($('input[name=available_budget]').val());
        var request =  parseInt($('input[name=cost]').val());
        $('div.error').text('');
        if(avail  < request){
          e.preventDefault();
          $('div.error').text('Deducted budget exceeded available budget.');
           $('div.error').show();
        }
    });

    $(document).on('click','button#budget_approve' , function(e){
        var ref = $(this).attr('ref');
         var cur_page =  $('input[name=current_page]').val();

      //  var request =  parseInt($('input[name=cost]').val());
          $.ajax({
              type: "POST",
              url: 'budget_approved',
              data: {'id': ref , 'is_granted': '1','current_page': cur_page},
              success: function(data){
                console.log(data);
                if(data){
                    var  hrf =  window.location.href;
                    window.location.href = hrf+'?s=1'; 
                }else{
                     var  hrf =  window.location.href;
                    window.location.href = hrf+'?e=1'; 
                }
                  
              }
          });
       
    });

     $(document).on('click','button#budget_reject' , function(e){
        var ref = $(this).attr('ref');
        var cur_page =  $('input[name=current_page]').val();
        var conf = confirm('Are you sure you want to reject the request?');

      if(conf){
          $.ajax({
              type: "POST",
              url: 'budget_rejected',
              data: {'id': ref , 'is_granted': '2','current_page': cur_page},
              success: function(data){
                    var  hrf =  window.location.href;
                    window.location.href = hrf+'?s=2'; 
              }
          });
      }
       
    });

    $('input[name=settings_submit]').click(function(e){
      e.preventDefault();
        var cur_page =  $('input[name=cur_page]').val();
        $('div.error').text('');
          $.ajax({
              type: "POST",
              url: 'settings_db',
              data: {'form': $('form').serializeArray() ,'current_page': cur_page},
              success: function(data){
                var response = JSON.parse(data);
                if(response['err'] != 0){
                   $('div.error').html(response['err_msg']);
                   $('div.error').show();
                }else{
                  $('div.error').hide();
                  var  hrf =  window.location.href;
                    window.location.href = hrf+'?s=2'; 
                }
                    
              }
          });
    });

    $(document).on('click','input[name=add_tr]', function(e){
      e.preventDefault();
        var cur_tr=  $(this).parents('tr');
        $('table tbody').append(cur_tr.clone())
        if( $('table tbody').find('tr:last td:last input.btn-warning').length == 0){
          $('table tbody').find('tr:last td:last').append("<input type='button' name='remove_tr' class='btn btn-warning' value='-'>");
      }
        $('table tbody').find('tr:last input[name=available_budget]').val('');
        $('table tbody').find('tr:last input[name=cost]').val('');

   
    });

    $(document).on('click','input[name=remove_tr]', function(e){
      e.preventDefault();
        var cur_tr=  $(this).parents('tr').fadeOut();
    });

      $(document).on('click','button#add_more' , function(e){
        e.preventDefault();
         var form = $('form').find('.docs').last();
         $('form .docs:last').append(form.clone());
         $('form .docs:last input[type=file]').removeAttr('required')
      });

    $('select[name=sponsor_id]').change(function(){
      var sponsors = JSON.parse($('select[name=sponsor_id]  option:selected').attr('ref'));
      console.log(sponsors);
      $('select[name=b_project_sponsors]').find('option:gt(0)').remove();
     if( $('select[name=grant_id]').length  > 0){

      $('select[name=b_grant_id]').find('option:gt(0)').remove();
    }
  });

     $(document).on('change','select[name=sponsor_id]',function(){

    //  var grant_item = ($(this).attr('ref') !== undefined) ? JSON.parse($(this).attr('ref')) : {} ;
    var grant_item = JSON.parse($('select[name=sponsor_id]  option:selected').attr('ref'));
console.log(grant_item);

  
      $('select[name=grant_id]').find('option:gt(0)').remove();


      $.each(grant_item,function(i,e){
        var opts = "<option id="+i+" value='"+i+"' avi = "+e+">"+e+"</option>";
        $('select[name=grant_id]').append(opts);
      });


    });
   
   $(document).on('click','button#rem_attach',function(){
        var ref_id = $(this).attr('ref');
        var path = $(this).attr('path');
        var processs = 'documents';
        var conf = confirm("Are you sure you want to remove the attachment?");
        if(conf){
            $.ajax({
              type: "POST",
              url: 'remove_attachment',
              data: { 'process': processs, 'ref_id': ref_id ,'path': path},
              success: function(data){
                console.log(data);
                   $("tr[ref='"+ref_id+"']").fadeOut();

              }
            });
          
        }
    })
});

