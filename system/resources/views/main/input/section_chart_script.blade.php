<script type="text/javascript" src="{{asset('asset/js/moment.js ')}}"></script>
<script type="text/javascript">
	var pusdatinV3chart;
	jQuery(function(){
		var par = $('#ahm-chart-container').parent()
		var ctx = $("#myChart");
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: {!! json_encode(array_map(function($data){
		        	return $data->geo_prov_nama;
		        },$provinsi)) !!},
			    datasets:
			    	[@yield('chart-data')]
			    /* [	{
			      	         
			     	{{--*/$vvv =12/*--}}
			     		label:"Jumlah DPC",
			     		data:[ @foreach($test as $row)
			     					
			     					{{$row->jml?:1}},
			     			
					       		 	@endforeach
								12],
			     				{{--*/ $str='rgba('.rand(0,255).','.rand(0,255).','.rand(0,255).',1)'/*--}}
			     		backgroundColor: 'rgba(255,0,0,0.5)',
			            borderColor:'rgba(255,0,0,1)',
			            borderWidth: 1,
			            hidden:false,
			     	},
			     	{
			     		label:"Jumlah Jabatan Total",
			     		data:[ @foreach($countstruktot as $row)
			     				
			     					{{$row->jml}},
			     				
					       		 	@endforeach
								],
			     				{{--*/ $str='rgba('.rand(0,255).','.rand(0,255).','.rand(0,255).',1)'/*--}}
			     		backgroundColor: 'rgba(150,100,0,0.5)',
			            borderColor:'rgba(150,100,0,1)',
			            borderWidth: 1,
			            hidden: true,
			        },
			     	{
			     		label:"Jumlah Jabatan Tersedia",
			     		data:[ @foreach($countstrukav as $row)
			     				
			     					{{$row->jml}},
			     	
					       		 	@endforeach
								],
			     				{{--*/ $str='rgba('.rand(0,255).','.rand(0,255).','.rand(0,255).',1)'/*--}}
			     		backgroundColor: 'rgba(0,0,0,0.5)',
			            borderColor:'rgba(0,0,0,1)',
			            borderWidth: 1,
			            hidden:false,
			        },
			        {
			        	label:"Jumlah Kabupaten",
			     		data:[ @foreach($countkab as $row)
			     				
			     					{{$row->jml?:1}},
			     				
					       		 	@endforeach
								],
			     				{{--*/ $str='rgba('.rand(0,255).','.rand(0,255).','.rand(0,255).',1)'/*--}}
			     		backgroundColor: 'rgba(243, 156, 18, 0.5)',
			            borderColor:'rgba(243, 156, 18,1)',
			            borderWidth: 1,
			            hidden:false,
			        }
			     	]*/
		        /*[ {
		    
		            data: [12, 19, 3, 5, 2, 3,3,4,5,6,7,8],
		         
		            backgroundColor: 'rgba(255, 99, 132, 0.2)',
		            borderColor:'rgba(255,99,132,1)',
		            borderWidth: 1
		        },
		        ]
		        */
		    },
		    options: {
		  		hover:{
		  			mode:'dataset',
		  			onHover:function(e){
		  				//console.log(e)
		  				e.target.dataset
		  			}
		  		},
		    	elements:{
		    		rectangle:{
		    			//backgroundColor:'rgba(255,255,100,0.5)',
		    		}
		    	},
		    	legend:{
		    		display:true,
		    		onClick:function(event, legendItem){
		    			//legendItem.hidden=!legendItem.hidden
		    			myChart.data.datasets[legendItem.datasetIndex].hidden=!myChart.data.datasets[legendItem.datasetIndex].hidden;
		    			myChart.update();
		    		}
		    	},
	    	  	responsive: true,
		        scales: {
		        	
		        	yAxes: [{
						stacked: true,
                		ticks: {
            			 	// beginAtZero:true
                		}
            		}],
		            xAxes: [{
		            	barValueSpacing: 20,
						stacked: true,
		                ticks: {
		                	fontSize: 10,
		                	beginAtZero:true,
		                   	minRotation:90,
		                    callback: function(value, index, values) {
            			 	//fun place
            			 		//if 

            			 		return value;
		                    }
		                }
		            }]
	        	},
	        	tooltips: 
				{

				    bodyFontColor: "#000000", //#000000
				    bodyFontSize: 10,
				    bodyFontStyle: "bold",
				    bodyFontColor: '#FFFFFF',
				    bodyFontFamily: "'Helvetica', 'Arial', sans-serif",
				    footerFontSize: 12,
				    position:'nearest',
				    callbacks: {
				    	title:function(tti,data){
				    		//return tti.yLabel;
				    		//console.log(tti)
				    	},
				        label:function(tti,data){
				        	//console.log(ttItem)
				        	//console.log(data)
				                var value = data.datasets[0].data[tti.index];
				                {{--*/$i1=0/*--}}
				            /*@foreach($kabn as $kabno)
						            if(tti.index == {{$i1}}) {
						            	{{--*/$i2=0/*--}}
						            	@foreach($kabno as $row)
						            	
						            		if(tti.datasetIndex=={{$i2}}){
						            			return '{{$row->geo_kab_nama}}';
						            		}
						            		{{--*/$i2++/*--}}
						            	@endforeach
						               {{$i1++}}
						            }
						        @endforeach */
						   
						        {{--*/$i2=0/*--}}
						         @foreach($kabn as $kabno)	
						            		if(tti.datasetIndex==0 && tti.index=={{$i2}}){
						            			var str=[];
						            			@foreach($kabno as $row)
						            				str.push('{{$row->geo_kab_nama.' : '.$row->jml_dpc}}');
						            			@endforeach
						            			return str;
						            		}
						            		{{--*/$i2++/*--}}       			
				            	@endforeach    
				        },
				    },
				    custom: function(tooltip) {
		                // tooltip will be false if tooltip is not visible or should be hidden
		                if (!tooltip) {
		                    return;
		                }
		               	//websiteChart.config.data = some_new_data;
						//websiteChart.update();

		                // tooltip.caretPadding
		                // tooltip.chart
		                // tooltip.cornerRadius
		                // tooltip.fillColor
		                // tooltip.font...
		                // tooltip.text
		               // tooltip.x = 12;
		                tooltip.y = 12;
		               	//console.log(tooltip)
		            	
		                tooltip.caretX=100;
		                tooltip.caretSize=0;
		                // etc...
		            }
				},
				animation:{	
					duration: 0,
					callback:function(anim){
						//console.log(anim)
					},
	        		render:function(anim){
	        			//console.log(anim)
	        		},
				    onComplete: function (anim) {
				    	
				        
				    }
	        	}
		    }

		});
		Chart.plugins.register({
			afterEvent: function(chartI,e) {
				var elem=chartI.getElementAtEvent(e)
				console.log(elem)
				if(e.type='mousemove'){//check mouse hover
					if(elem.length > 0){//tampilkan tooltip hanya jika data lebih dari 0
						if(elem[0]._datasetIndex==0){//check bagian terbawah chart/ chart pertama, hanya tampilkan tooltip pada chart pertama
							chartI.config.options.tooltips.enabled=true;
						}
						else chartI.config.options.tooltips.enabled=false;
					 	if(elem[0]._index < 17){ //jika index lebih dari 17 posisikan tooltip ke kiri
								chartI.tooltip._model.x=-$('#ahm-chart-container').parent().position().left+$('#ahm-chart-container').parent().parent().width()-(chartI.tooltip._model.width);
						}else chartI.tooltip._model.x=-$('#ahm-chart-container').parent().position().left;
					}
				}
			},
    		afterDatasetsDraw: function(chartI) {
				//console.log(chartI)
		        var ctx = chartI.chart.ctx;
		        ctx.font = chartI.chart.ctx.font;
		        ctx.fillStyle = 'black';
		        //ctx.textColor = '#000';
		        ctx.textAlign = "center";
		        ctx.textBaseline = "bottom";
		        ctx.font="10px Arial";

		        chartI.data.datasets.forEach(function (dataset,i) {
		        	//console.log(dataset)
		        	var meta = dataset._meta[0];
		            meta.data.forEach(function (bar,i) {
		            	var data = dataset.data[i]; 
		            	//console.log(bar)
		            	var add=0;
		            	if (data<14){
		               		ctx.font="8px Arial";
		               		add=-2;
		            	}
		            	else if (data<30){
		               		ctx.font="10px Arial";
		            	}
		            	else if  (data<50){
		            		ctx.font="12px Arial";
		            		add=4;
		            	}
		            	else if  (data>=50){
		            		ctx.font="BOLD 14px Arial";
		            		add=6;
		            	}
		            	if (data>10){
		            		if(!dataset.hidden)
		            		ctx.fillText(data, bar._model.x, bar._model.y+12+add);
		            	}
		            	else if(bar.height()>8){
		            		if(!dataset.hidden)
		            		ctx.fillText(data, bar._model.x, bar._model.y+12+add);
		            	}
		            	//console.log(bar)
		            });
		        });
			}
		});
		$('#ahm-table').on('click','tr',function(e){
		   	var row_object  = allTable.row(this).data();
		    var nm         = allTable.row(this).data()['Nama'];
		    var prov        = allTable.row(this).data()['Provinsi'];
		    console.log(row_object)
		});
		$("#chart-mode-group").on('click',function(){
			myChart.scales["x-axis-0"].options.stacked=false;
			myChart.scales["y-axis-0"].options.stacked=false;
			myChart.update();
		})
		$("#chart-mode-stack").on('click',function(){
			myChart.scales["x-axis-0"].options.stacked=true;
			myChart.scales["y-axis-0"].options.stacked=true;
			myChart.update();
		})
		$('#chart-config').on('click','a',
			(function(){
				var currentIndex={};
				var selected={};
				var allowRex=true;
				return function(e){
					e.preventDefault();
					var label="Data";
					color ='orange'
					var idx=$(this).attr('data-index');
					var grp=$(this).attr('data-group');
					var me = $(this);
					var urli="";
					switch(idx){
						case '1':
							label = "Jumlah Laki-Laki";	
							urli='data_ajx/get/bio_gender/l'
							color ='196, 96, 47'	
							break;
						case '2':
							label = "Jumlah Perempuan";	
							urli='data_ajx/get/bio_gender/p'
							color = "237, 33, 80"	
							break;
						case '3':
							label = "Jumlah Gender Belum Diketahui";	
							urli='data_ajx/get/bio_gender/a'	
							color = '114, 96, 96'
							break;
						case '4a':
							label = "Jumlah DPP by SK";
							urli = 'data_ajx/get/bio_menjabat_by_sk/dpp';
							color = '232, 54, 34';
							break;
						case '4b':
							label = "Jumlah DPD by SK";
							urli = 'data_ajx/get/bio_menjabat_by_sk/dpd';
							color = '247, 203, 93';
							break;
						case '4c':
							label = "Jumlah DPC by SK";
							urli = 'data_ajx/get/bio_menjabat_by_sk/dpc';
							color = '255, 216, 0';
							break;
						case '5':
							label = "Jumlah DPP";
							urli = 'data_ajx/get/bio_menjabat/dpp';
							color = '204, 198, 91';
							break;
						case '6':
							label = "Jumlah DPD by prov";
							urli = 'data_ajx/get/bio_menjabat/dpd';
							color = '155, 99, 80';
							break;
						case '7':
							label = "Jumlah DPC by prov";
							urli = 'data_ajx/get/bio_menjabat/dpc';
							color = '196, 39, 86';
							break;
						case '8':
							label = "Jumlah PAC by prov";
							urli = 'data_ajx/get/bio_menjabat/pac';
							color = '132, 60, 86';
							break;
						case '9':
							label = "Jumlah PAR by prov";
							urli = 'data_ajx/get/bio_menjabat/par';
							color = '196, 150, 141';
							break;
						case '10':
							label = "Jumlah KPA by prov";
							urli = 'data_ajx/get/bio_menjabat/kpa';
							color = '165, 63, 0';
							break;
						case '11':
							label = "Jumlah DPC by SK";
							urli = 'data_ajx/get/dpc_by_sk';
							color = '96, 86, 81';
							break;
						default:
							console.log('hello')
							jQuery(this).parent().siblings().each(function(i,v){
							if($(this).children('a').attr('data-group')==grp){
									$(this).children().children().addClass('glyphicon-unchecked').removeClass('glyphicon-check')
								}
							});
							$(this).children().removeClass('glyphicon-unchecked').addClass('glyphicon-check')
							
							return;
					}
					jQuery(this).toggleClass('navbar-inverse navbar-default');
					if(allowRex){
						console.log(currentIndex)
						console.log(selected)
						console.log(allowRex)//http://localhost/pusdatin_v3/data_pengurus/dpc#
						allowRex=false;
						selected[idx]=!selected[idx];
						if(selected[idx]){
							jQuery.ajax({
								url:'{{url()}}/'+urli,
								success:function(res,sts,xhr){
									allowRex=true;
									var newData={	{{--*/$vvv =12/*--}}
							     		label:label,
							     		data:JSON.parse(res),
							     				{{--*/ $str='rgba('.rand(0,255).','.rand(0,255).','.rand(0,255).',1)'/*--}}
							     		backgroundColor: 'rgba('+color+',0.5)',
							            borderColor:'rgba('+color+',1)',
							            borderWidth: 1,
							            hidden:false,
							        }
							        currentIndex[idx]=myChart.data.datasets.length;
									myChart.data.datasets.push(newData)       
									myChart.update();
								},

							});
							console.log('pas 1')
						}
						else{ 
							myChart.data.datasets.splice(currentIndex[idx],1);
							myChart.update();
							console.log('pas 2')
							allowRex=true;
						}
					}
					
		     	}
		 })());
		pusdatinV3chart = myChart
		console.log(myChart)
	});
</script>