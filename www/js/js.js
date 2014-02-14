
 $(function(){
   $("#datepicker").datepicker({
      monthNames:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
      dayNamesMin:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],
      firstDay:1,
      dateFormat:"dd.mm.yy",
      navigationAsDateFormat:true,
      nextText: "Следующий",
      prevText: "Предыдущий"
   });
   $("#accordion").accordion({
       collapsible:true,
       active:false,
   });
 });


