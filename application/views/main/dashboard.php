<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl;?>assets/sass/main.css">
    <link href="<?php echo $baseurl;?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo $baseurl;?>assets/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="<?php echo $baseurl;?>assets/css/google-roboto-300-700.css" rel="stylesheet" />
    <link href="<?php echo $baseurl;?>assets/img/logo-icon.png" rel="icon" >
    
</head>
<body>
    <input type="hidden" id="txtsite" value="<?php echo $siteurl;?>" />
    <input type="hidden" id="txtbase" value="<?php echo $baseurl;?>" />
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        <img src="<?php echo $baseurl;?>assets/img/logo.png" alt="logo" style="width: 100%;">
                    </a>
                </div>
    
                <ul class="nav">
                    <li class="<?php echo ($menu == 'Dashboard')?'active':'';?>" id="">
                        <a href="<?php echo $baseurl;?>Dashboard">
                            <i class="fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="<?php echo ($menu == 'Data')?'active':'';?>" id="">
                        <a href="<?php echo $baseurl;?>Data">
                            <i class="fa fa-folder-open"></i>
                            <p>Data</p>
                        </a>
                    </li>
                    <li class="<?php echo ($menu == 'Master')?'active':'';?>" id="">
                        <a href="<?php echo $baseurl;?>Master">
                            <i class="fa fa-tags"></i>
                            <p>Master</p>
                        </a>
                    </li>
                    <li class="active-pro">
                        <a href="">
                            <i class="fa fa-cogs"></i>
                            <p>Setting</p>
                        </a>
                    </li>
                </ul>
            </div>          
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default nabvar-fixed">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse">
                       
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    <span class="notification" style="margin-left:-20px;"><?php echo $notification;?></span>
                                      <p class="hidden-md hidden-lg">
                                      Message
                                      <b class="caret"></b>
                                      </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="masaberlaku.html">Notification 1</a></li>
                                    <li><a href="masaberlaku.html">Notification 2</a></li>
                                    <li><a href="masaberlaku.html">Notification 3</a></li>
                                    <li><a href="masaberlaku.html">Notification 4</a></li>
                                </ul>
                            </li>      
                            <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <p>
                                        Administrator
                                        <b class="caret"></b>
                                        </p>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#">Logout</a></li>
                                  </ul>
                            </li>    
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>

                </div>
            </nav>

            <div class="contents">
                <div class="container-fluid">
                    <div class="row">
                        <h2 class="title"></h2>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">TERSUS</h4>
                                    <p class="category" style="color: #AAAAAA; font-weight: 300;">Jumlah Total TERSUS semua Provinsi</p>
                                </div>
                                <div id="container-pie"></div>  
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">TUKS</h4>
                                    <p class="category" style="color: #AAAAAA; font-weight: 300;">Jumlah Total TUKS semua Provinsi</p>
                                </div>
                                <div id="container-pie2"></div>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">TERSUS & TUKS</h4>
                                    <p class="category" style="color: #AAAAAA; font-weight: 300;">Jumlah Per Provinsi</p>
                                </div>
                                <div id="container-bar"></div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>

<script src="<?php echo $baseurl;?>assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl;?>assets/js/light-bootstrap-dashboard.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts-exporting.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts-export.js"></script>
<script src="<?php echo $baseurl;?>assets/js/highchart/highcharts-access.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	Highcharts.setOptions({
        colors: ['#A3A0FB', '#43425D']
      
	});
	var Total = 0;

	var chart_tusk = new Highcharts.chart({
	    chart: {
	        renderTo: 'container-pie',
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie',
	        events: {
	            load: function(event) {
	                $('.highcharts-legend-item').last().append('<br/><div style="margin-left:2rem;"><hr/><span style="float:left;font-weight: bold;padding-bottom:2px;">Total</span><span style="float:left;color:#9A9A9A;font-weight: 700;"> ' + Total + '</span> </div>')
	            }
	        }  
	    },
	    title: {
	        text: ''
	    },
	    credits: {
	    enabled: false
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: false
	            },
	            showInLegend: true
	        }
	    },
	   	legend: {
	        useHTML: true,
			labelFormatter: function() {
	            Total += this.y;
				return '<div style="width:auto"><span style="float:left">'+ this.name +' :'+'</span><span style="float:left;color:#9A9A9A;font-weight: 400;">' + this.y + '</span></div>';
			},
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'top',
	        x:-10,
	        itemMarginTop: 5,
	        itemMarginBottom: 5,
	        
	    },
	    series: [{
	        name: 'Status',
	        colorByPoint: true,
	        innerSize: '50%',
	        data: <?php echo $tersus; ?>
	    }],
	    navigation: {
	        buttonOptions: {
	            verticalAlign: 'top',
	            align: 'left',
	        }
	    },
	    exporting: {
	        buttons: {
	            contextButton: {
	                menuItems: ['downloadXLS','viewData']
	            }
	        }
	    } 
	});

	Highcharts.setOptions({
		colors: ['#6bd189', '#ffb700']
	});

	var Total = 0;
	var chart_tersus = new Highcharts.chart({
	    chart: {
	        renderTo: 'container-pie2',
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie',
	        events: {
	            load: function(event) {
	            $('.highcharts-legend-item').last().append('<br/><div style="margin-left:2rem;"><hr/><span style="float:left;font-weight: bold;padding-bottom:5px;">Total :</span><span style="float:left;color:#9A9A9A;font-weight: 700;"> ' + Total + '</span> </div>')
	            }
	        }  
	        
	    },
	    title: {
	        text: ''
	    },
	    credits: {
	    enabled: false
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: false
	            },
	            showInLegend: true
	        }
	    },
	    legend: {
	        useHTML: true,
			labelFormatter: function() {
	            Total += this.y;
				return '<div style="width:auto"><span style="float:left">'+ this.name +' :'+'</span><span style="float:left;color:#9A9A9A;font-weight: 400;">' + this.y + '</span></div>';
			},
	        layout: 'vertical',
	        align: 'right',
	        verticalAlign: 'top',
	        x:-10,
	        itemMarginTop: 5,
	        itemMarginBottom: 5,
	    },
	    series: [{
	        name: 'Status',
	        colorByPoint: true,
	        innerSize: '50%',
	        data:<?php echo $tuks; ?>
	    }],
	    navigation: {
	        buttonOptions: {
	            verticalAlign: 'top',
	            align: 'left',
	        }
	    },
	    exporting: {
	        buttons: {
	            contextButton: {
	                menuItems: ['downloadXLS','viewData']
	            }
	        }
	    } 
	});


	Highcharts.setOptions({
		colors: ['#A3A0FB','#43425D','#6bd189','#fcbf1e']
	});
	
	var chart_bar = new Highcharts.chart({
    chart: {
        renderTo: 'container-bar',
        type: 'bar',
    },
    xAxis: {
        categories: <?php echo $provinsi; ?>,
        labels: {
        style: {
            fontSize: '14px',
            color: '#43425D'
        }
        }, 
        title: {
            text: null
        },
        min: 0,
        max:6,
        scrollbar: {
        enabled: true
        },
        tickLength: 0,   
    },
    yAxis: {
        title: false, 
    },
    title: {
        text: 'TERSUS & TUKS PROVINSI'
    },
    credits: {
    enabled: false
    },
    tooltip: {
        formatter: function () {
        return '<b>' + this.x + '</b><br/>' +
        '<b>'+ this.series.name +'</b>'+ ' : '+'<b>' + this.y + '</b>'+'<br/>' + 
        'Total ' + this.series.userOptions.stack + ' : '+  this.point.stackTotal ;
        }
    },
    plotOptions: {
        series: {
            point: {}
        },
        bar: {
            stacking: 'normal',
            states: {
                inactive: {
                enabled: false
                },
                hover: {
                color: '#4baee3',  
                }
            },
            cursor: 'pointer',
            showInLegend: true,
        }
    },
//    legend: {
//     reversed: true
//     },
    series: [   
        {
        name: 'Tersus Aktif',
        data: <?php echo $tersus_aktif;?>,
        stack: 'Tersus'
        },   
        {
        name: 'Tersus Non Aktif',
        data: <?php echo $tersus_nonaktif;?>,
        stack: 'Tersus',
        // borderRadiusTopLeft: 10,
        // borderRadiusTopRight: 10
        },
        {
        name: 'Tuks Aktif',
        data: <?php echo $tuks_aktif;?>,
        stack: 'Tuks'
        }, 
        {
        name: 'Tuks Non Aktif',    
        data: <?php echo $tuks_nonaktif;?>,
        stack: 'Tuks',
        // borderRadiusTopLeft: 10,
        // borderRadiusTopRight: 10
        },
          
    ], 
    navigation: {
        buttonOptions: {
            verticalAlign: 'top',
        }
    },
    exporting: {
        buttons: {
            contextButton: {
                menuItems: ['downloadXLS','viewData']
            }
        }
    }  
});

	
});
</script>

</html>
<!-- comment bcos the value from controller couldnt get from js 
<script type="text/javascript" src="<?php echo $baseurl;?>assets/js/dashboard.js?v=<?php echo uniqid(); ?>"></script> 
-->