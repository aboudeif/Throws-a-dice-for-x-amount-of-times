<html>
  <head>
    <title>PHP Test</title>
    <link rel='stylesheet' href='style.css'>
    
  </head>
  <body>
    
    <?php 

    # هذا المتغير يمثل عدد مرات رمي النرد
    $number = 5; # قم بتغيير هذا الرقم
    #  يمكن اختيار طريقة عمل البرنامج من هنا بإدخال القيم لهذا المتغير
    # 'f' = 'for loop' [و] 'w' = 'while loop'
    $loop = 'w'; # قم بتغيير هذا الحرف

    # هذه الدالة تقوم بتوليد النقاط داخل كل وجه من أوجه النرد
    function dots($i){
      $str = "";
      while($i > 0){
        $str .= "<div class='dot'></div>";
        --$i;
      }
      return $str;
    }
    # مصفوفة لحفظ أوجه النرد
    $dice = [];
    for($i = 1; $i < 7; $i++)
      $dice[$i] = "<div class='dice-face' id='f_".$i."'>".dots($i)."</div>";
  
    # بداية تنفيذ البرنامج والتأكد من قيمة عدد مرات رمي النرد
    if($number >= 0)
      $dataPoints = start($dice,$loop,$number);
    # لو كان عدد مرات رمي النرد أصغر من صفر تظهر سالة الخطأ للتوضيح
    else
      echo "<br /><div class='error' dir='rtl'>خطأ : عدد مرات رمي النرد يجب أن يكون أكبر من أو يساوي الصفر بينما القيمة المدخلة هي  [ ".$number." ]</div>";
    # هذه الدالة هي التي تقوم بكل العمل
    function start($dice,$loop,$number)
    {
      # في المصفوفة التالية يتم تخزين أرقام النرد و عدد مرات ظهور الرقم
      $result = [];
      # يتم التأكد من قيمة المتغير المحدد لطريقة عمل البرنامج
      switch($loop)
      {
        # for لو اخترنا طريقة الحلقات التكرارية 
        case 'f':
          {
            # أولاً يتم تخزين أرقام النرد الستة في المصفوفة وإعطاء كل رقم القيمة صفر
            for($i = 1; $i <= 6; $i++)
              $result[$i] = 0;
            # ثانياً يتم اختيار رقم عشوائي من أرقام النرد وزيادة قيمته بمقدار واحد وتكرر العملية بعدد مرات رمي النرد
            echo "<div class='container'>";
            echo "<div class='cards'>";
            for($i = 0; $i < $number; $i++)
            {
              $random = rand(1,6);
              echo $dice[$random];
              $result[$random] += 1;
            }
            echo "</div>";
            # وثالثاً يتم طباعة كل رقم من أرقام النرد و عدد مرات ظهوره
            echo "<br /><div class='main'>";
            echo "<p class='result'>";
            foreach($result as $key=>$value)
              echo $key ." occurred ". $value ."<br />";
            echo "</p>";
            echo "<br /><p class='details'>";
            # دالة بيانات الرسم البياني
            $dataPoints = array();
            # نسبة ظهور كل وجه
            $presentage = 0;
            # رابعاً يتم طباعة رقم كل وجه و نسبة ظهوره
            foreach($result as $key=>$value){
           $presentage = round(($value/$number)*100,0);
              echo $key ." &rarr; ". $presentage ."%<br />";
            # تخزين أرقام كل وجه ونسبة ظهوره داخل مصفوفة الرسم البياني
              array_push($dataPoints,array("label" => $key, "y" => $presentage));
            }
            echo "</p>";
            #مكان ظهور الرسم البياني
            echo "<p id='chartContainer'></p>";
            echo "</div>";
            return $dataPoints;
            break;
          }
        # while لو اخترنا طريقة الحلقات التكرارية 
        case 'w':
          {
            # أولاً يتم تخزين أرقام النرد الستة في المصفوفة وإعطاء كل رقم القيمة صفر
            $i = 0;
            while($i < 6)
              $result[++$i] = 0;
            # ثانياً يتم اختيار رقم عشوائي من أرقام النرد وزيادة قيمته بمقدار واحد وتكرر العملية بعدد مرات رمي النرد.
            echo "<div class='container'>";
            echo "<div class='cards'>";
            $i = 0;
            while($i < $number)
            {
              $random = rand(1,6);
              echo $dice[$random];
              $result[$random] += 1;
              $i++;
            }
            echo "</div>";
            # وثالثاً يتم طباعة كل رقم من أرقام النرد و عدد مرات ظهوره
            echo "<br /><div class='main'>";
            echo "<p class='result'>";
            $i = 0;
            while($i < 6)
              echo ++$i ." occurred ". $result[$i]."<br />";
            echo "</p>";
            echo "<br /><p class='details'>";
            # دالة بيانات الرسم البياني
            $dataPoints = array();
            # نسبة ظهور كل وجه
            $presentage = 0;
            # رابعاً يتم طباعة رقم كل وجه و نسبة ظهوره
            $i = 0;
            while($i < 6){
              $presentage = round($result[++$i]/$number,2)*100;
              echo $i ." &rarr; ". $presentage ."%<br />";
              # تخزين أرقام كل وجه ونسبة ظهوره داخل مصفوفة الرسم البياني
              array_push($dataPoints,array("label" => $i, "y" => $presentage));
            }
            echo "</p>";
            #مكان ظهور الرسم البياني
            echo "<p id='chartContainer'></p>";
            echo "</div>";
            return $dataPoints;
            break;
          }
        #  لو ادخلنا لمتغير تحديد الجمل التكرارية قيمة خطأ تظهر الرسالة التالية 
        default:
        {
          echo "<br /><div class='error' dir='rtl'> خطأ : طريقة الجمل الشرطية في اليرنامج يجب أن تأخذ إما القيمة ' f ' أو ' w ' بينما القيمة المدخلة هي ' ".$loop." '</div>";
          #
        }
      }
    }
    # زر إعادة تحميل الصفحة
    echo "<div class='control'><a href='.'><div class='refresh'>Play again</div></a></div>";
     ?> 
    <!-- دالة استدعاء الرسم البياني -->
    <script>
    window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer", {
	  animationEnabled: true,
	  exportEnabled: false,
	  theme: "light1", // "light1", "light2", "dark1", "dark2"
	  title:{
		text: ""
	  },
	  axisY:{
		includeZero: false
	  },
	  data: [{
		type: "pie",
		indexLabel: "{y}",
		yValueFormatString: "#0\"%\"",
		indexLabelPlacement: "outside",
		indexLabelFontColor: "#36454F",
		indexLabelFontSize: 14,
		indexLabelFontWeight: "bold",
		showInLegend: true,
		legendText: "{label}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
    chart.render();
 
    }
    </script>
 <!--  استدعاء مكتبة الرسم البياني-->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  </body>
</html>