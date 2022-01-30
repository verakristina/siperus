//copyright achmad firdaus
//required js = jQuery, helper.js, moment.js,  slimscroll.jquery.js
//required styles = bootstrap24-modified, ahmadApp, font-awesome, awesome-bootstrap-checkbox 

jQuery.fn.extend({
	AhmTextAsyncData:function(configA){
		var me=this;
		var config={
			ajaxUrl:configA.ajaxUrl,
			selToInput:configA.selToInput||false,
			onSelectedItem:configA.onSelectedItem,
			value:configA.value || 0,
			text:configA.text || "",
			placeholder: configA.placeholder||"...",
			inputName: configA.inputName||"",
		};
		var selToInput=config.selToInput;
		var inp=jQuery('<input type="text"  class="form-control" name="" placeholder="'+config.placeholder+'">');
		var inph=jQuery('<input type="hidden"  class="form-control" name="'+config.inputName+'" >');
		var listBox=jQuery('<div class="list-group panel-shadow" style="width:100%;position:absolute;diplay:none;z-index:12"></div>');
		var boxStr='<div class="list-group-item ahm2" style="cursor:pointer;"></div>';
		var load=jQuery('<div class="list-group-item " style="display:none"><i class="fa fa-spin fa-refresh fa-2x "></i></div>');
		var notFound=jQuery('<div class="list-group-item">Data Tidak Ditemukan...</div>')
		jQuery(listBox).append(load);
		jQuery(inp).on('click',function() {
			if (jQuery(inp).hasClass('text-box-danger')){
				jQuery(inp)[0].value="";
				jQuery(inp).removeClass('text-box-danger');
			}
		});
		var selected={
			text:"test",
			val:0,
		}
		var me=this;
		var reqAjax=(function(){
        	var allowReq=true;
        	return function(str){
        		if (allowReq){
        			allowReq=false;
        			jQuery.ajax({
						url:config.ajaxUrl+"/"+str,
						type:'get',
						success:function(res){
							allowReq=true;
							var res=JSON.parse(res);
							//console.log(res)
							if(res.length>0){
								
								for(v of res){
									var box=jQuery(boxStr);
									box.text(v.text);
									jQuery(box).on('click',
										(function(vo){
											var va=vo;
											

											return function(e){
												selected=va;
												
												config.onSelectedItem(va,me);
												if (selToInput)
												inp.val(va.text)
												inph.val(va.val)
												jQuery(listBox).hide();

											}
										})(v)
									);
									jQuery(listBox).append(box);
									
								}
							}else jQuery(listBox).append(notFound);
						}
					});
        		}
        	}
        })();
		this.setText=function(text){
			inp.val(text);
			selected.text=text;
		}
		this.setValue=function(val){
			selected.val=val;
			inph.val(val);
		}
		this.setAjax=function(str){
			config.ajaxUrl=str;
		}
		this.setInputColor=function(){
			
		}
		this.showWarning=function(text){
			jQuery(inp)[0].value=text;
			jQuery(inp).addClass('text-box-danger');
			
		}
		this.init=function(text,val){
			me.setText(text);
			me.setValue(val);
		}
		this.init(config.text,config.value);
		function selectedItem(){
			//selected.text=this.text;
			//selected.val=this.myId;
			console.log(this.textContent)
		}
		console.log(config)
		var temp=jQuery('<div class="input-group">\
											</div>');
		temp.append( '<span class="input-group-addon"><i class="fa fa-search fa-fw"></i></span>');
		temp.append(inp);
		jQuery(this).append(inph);
		jQuery(this).append(temp);
		jQuery(this).append(listBox);
		jQuery(inp).bind('input propertychange', function() {
			
			jQuery(listBox).empty()
			jQuery(listBox).show();
			jQuery(listBox).append(load);
			//console.log(config)
			//console.log(this.text)
			//console.log(config.dataUrl+"/"+this.value);
			if(this.value.length>1){
				reqAjax(this.value);
			}else{
			jQuery(document).click(function(event){
				jQuery(listBox).hide();
			})
			jQuery(inp).click(function(event){
			   event.stopPropagation();
			});
			
			jQuery(document).ajaxStart(function () {
				//console.log("ajaax started")
			    load.show();
		    }).ajaxStop(function () {
		    	//console.log("ajaax stoped")
		        load.hide();
		    });
			
			 jQuery(listBox).empty();
			 jQuery(listBox).hide();
			};

		});
		this.getSelectedItem=function(e){return selected}
		return this;
	}
});
 
jQuery.fn.extend({
	AhmList:function(configA){
		var me=this;
		var arr=[];
		var dupListener=[]
		this.addDuplikatListener=function(list){
			dupListener.push(list);
		}
		var config={
			noDupikat:(configA.noDuplikat?true:false),
			onDuplikat:configA.onDuplikat
		}
		
		
		this.addDuplikatListener(config.onDuplikat);	
		var lst=jQuery("<div draggable='true'  class='row list-group-item ahm2' ></div>");
		var spn="<span class='fa fa-times-circle' style='float:right;cursor:pointer'></span>";
		var gabDrop="<div id='drp' class='row list-group-item ahm2' style='display:none;border:1px solid #000;background:#F3ABAB' >drop here...</div>"
		var msg="<div  class='row list-group-item alert alert-danger' style='width:400px'><strong>Nama Sudah Ada!!</strong></div>";
		var drager;
		this.createItems=function(item){
			console.log(lst)
			var lst2=jQuery(lst).clone();
			var spn2=jQuery(spn);
			var gabDrop2=jQuery(gabDrop);

			jQuery(lst2).append(spn2);
			jQuery(lst2).append(item.text);
			jQuery(this).append(gabDrop2);
			jQuery(this).append(lst2);
			console.log("akhir loop")
			arr.push(item.val);
			jQuery(spn2).on('click',function(){
				jQuery(this).parent().remove();
				var index = arr.indexOf(item.val);
				arr.splice(index, 1);
			})
		}
		this.clearItem=function(){
			arr=[];
			jQuery(this).empty();
		}
		this.getItems=function(){
			return arr;
		}
		this.addListRange=function(items){
			for(item of items){
				me.addList(item);
			}
		}
		this.addList=function(item){
			
			if (true){//debuging...
				if(arr.length==0)
					this.createItems(item)
				else
				for(i in arr){
					if (arr[i]===item.val){
						for(f of dupListener){
							f(me);
						}
						break;
					}
					if(i==arr.length-1) {
						this.createItems(item)
					}					
				}
			}
			else {
				jQuery(lst).text(item.text);
				console.log("dupli");
				jQuery('#cari-caleg').append(lst)
			};
		}
		return this;
	}
});
jQuery.fn.extend({
	AhmGroupCheckBox:function(configArgs){
		var config={
			valueTerpilih:((configArgs.checkedIndex===undefined)?-1:configArgs.checkedIndex),
			listValueTerpilih:((configArgs.listValueTerpilih===undefined)?[]:configArgs.listValueTerpilih),
			orientasi:((configArgs.orientasi===undefined)?'inline':configArgs.orientasi),
			hanyaSatuTerpilih:((configArgs.hanyaSatuTerpilih===undefined)?false:configArgs.hanyaSatuTerpilih),
			checkBoxList:configArgs.checkBoxList,
			colSize:((configArgs.colSize===undefined)?6:configArgs.colSize)
		}
		var checkBoxList={
			label:"label",
			value:0
		}
		var listValueTerpilih=config.listValueTerpilih;
		var valueTerpilih=config.valueTerpilih;
		var listCheckBox=[];
		var chk='<input type="checkbox" class="form-control" value="" name="">';
		this.getSelectedValue=function(){
			if(config.hanyaSatuTerpilih){
				return ValueTerpilih;
			}
			else{
				return listValueTerpilih;
			}
		}
		for(v of config.checkBoxList){
			var chki= jQuery(chk);
			chki.val(v.value);
			listCheckBox.push(chki);
			var lbl=jQuery('<label>'+v.label+'</label>');
			if(config.hanyaSatuTerpilih){
				chki.on('click',function(){
					console.log(this)
					for(i in listCheckBox){
						if(this!=listCheckBox[i]){
							listCheckBox[i][0].checked=false;
						}
					}
					this.checked=true;
					valueTerpilih=this.value;
					console.log(valueTerpilih)
				});
			}else{

				chki.on('click',function(){
					console.log(this.checked)
					if(this.checked){
						listValueTerpilih.push(this.value);
					}
					else listValueTerpilih.splice(listValueTerpilih.indexOf(this.value),1);
					console.log(listValueTerpilih)
				});
			}
			var abcChki=jQuery('<div class="checkbox  abc-checkbox">');
			abcChki.append(chki);
			abcChki.append(lbl);
			var par=jQuery(abcChki).wrap('<div>').parent();
			if(config.orientasi=='inline'){
				par.addClass("col-md-"+config.colSize);
			}else par.addClass("row");
			this.append(par);
		}
		this.setSelected=function(pass){

			if(!config.hanyaSatuTerpilih){
				listValueTerpilih=pass;
				//console.log("listCheckBox")
				//console.log(listCheckBox)
				for(v of pass){
					for(o of listCheckBox){
						//console.log(o[0].value)
						if (o[0].value===v){
							o[0].checked=true;
						}
					}
				}
			}else{
				valueTerpilih=pass;
				for(o of listCheckBox){	
					if (o[0].value===pass){
						o[0].checked=true;
					}
				}
			}
		};
		if(!config.hanyaSatuTerpilih)
		this.setSelected(listValueTerpilih);
		else this.setSelected(valueTerpilih);
		return this;
	},
});

jQuery.fn.extend({
	AhmDynList:function(configArgs){
	var btn=jQuery("<div type='button' id='btn-plus' class='btn btn-primary btn-semi-circle'>tambah <span class='fa fa-plus'></span></div>");
	var btn2=jQuery("<div type='button' id='btn-min' class='btn btn-primary btn-semi-circle'>hapus <span class='fa fa-minus'></span></div>");
	var config={
		listValue:((configArgs.listValue===undefined)?[]:configArgs.listValue),
	};
	var me=this;
	var listValue=config.listValue;
	var inputList=[];
	//if (input!=undefined)
	//	inputList=input;
	var l=jQuery('<div class="col-md-20" id="adder-ringkasan-place">');	
	var r=jQuery('<div class="col-md-4" id="adder-ringkasan" >');					
	this.append(l,r);
	this.addListItem=function(v){
		var i=jQuery("<div class='row' style='display:none'>\
			<div class='col-md-23 list-group-item nopad''><input  value='"+(v===undefined?"":v)+"' class='form-control' type='textarea'></div><span id='inptR"+inputList.length+"' class='btn btn-circle-right btn-primary fa fa-times-circle'></span></div>")
		inputList.push(i);

		l.append(i);
		jQuery(i).fadeIn();
		jQuery(i).on('click','span',function(){
			inputList.pop();
			jQuery(i).fadeOut();
			setInterval(function(){jQuery(i).remove()},3000)
			
			counter--;
		})
	}
	counter=inputList.length;
	r.append(btn,btn2);

	jQuery(btn).on('click',function(){
		
		counter++;
		if (counter>0)
			jQuery(btn2).addClass("btn-primary")
		me.addListItem()
	})
	jQuery(btn2).on('click',function(){
		var i=inputList.pop()
		jQuery(i).fadeOut();
		setInterval(function(){jQuery(i).remove()},3000)
		if (counter>0){
			counter--;
			
		}else jQuery(this).removeClass("btn-primary")
	})
	
	for(var v of listValue){
		this.addListItem(v)
	}
	
	this.getListValue=function(){
		console.log(inputList)
		var lst=[]
		for(var o of inputList){
			console.log(o)
			lst.push(jQuery(o).find('input').val())
		}
		return lst; 
	}
	this.getFormatedValue=function(format){
		if(format===undefined)format='###';
		return this.getListValue().join(format);
	}
	return this;
	},
})
jQuery.fn.extend({
	AhmSelectList:function(configArgs){	
		var config={
			listLabel:((configArgs.listLabel===undefined)?[]:configArgs.listLabel),
			listValue:((configArgs.listValue===undefined)?[configArgs.listLabel.length]:configArgs.listValue),
			onSelesaiEdit:(configArgs.onSelesaiEdit?configArgs.onSelesaiEdit:function(){}),
			onOpenEdit:configArgs.onOpenEdit||function(){},
		}
		
		this.createValue=function(lbl){
			lbl =lbl||[];
			if (!config.listValue)
				return arr=[];

			var arr=[lbl.length];
			var av=config.listValue.split(",")
			n:
			for(var a=0;a<lbl.length;a++){
				for(var b=0;b<av.length;b++){
					if(a===parseInt(av[b])-1){
						arr[a]=true;
						continue n;
					}
				}
				arr[a]=false;
			}
			//console.log(arr)
			return arr;
		}
		this.redimValue=function(lbl){
			lbl =lbl||[];
			if(!lbl.length>listValueFormated.length){
			 	listValueFormated[lbl.length-1]=false;
			 	listValueFormated.fill(false,lbl.length-listValueFormated.length)
			}

			return listValueFormated;
		}
		var selesaiEditListener=[]
		selesaiEditListener.push(config.onSelesaiEdit);
		var listValueFormated=this.createValue(config.listLabel);
		var listLabel=config.listLabel;
		var totalCount=listLabel.length;
		var arr=[];
		var $listLbl=[];
		var $listEditLbl=[];

		var wrp='<div class="row ahm2 list-group-item" ></div>';
		var l=jQuery('<div id="list-td" class="col-md-12 col-xs-24">');
		var r=jQuery('<div id="list-td" class="col-md-12 col-xs-24">');
		var state={
			edited:false,
			lastEditEdited:false,
		};
		
		this.init=function(lstLbl,lstVal,edit){
			listLabel=lstLbl;

			listValueFormated=lstVal||this.redimValue(lstLbl);
			arr=[];
			$listLbl=[];
		 	$listEditLbl=[];
			this.empty();
			l.empty();
			r.empty();
			for(i=1;i<=listLabel.length;i++){						
				var el=jQuery('<span style="cursor:pointer"  id="'+i+'list" " \
					class="col-md-2 col-xs-2 label-'+((listValueFormated[i-1])?'primary':'default')+' label labelahm">'+(i)+'</span>');
				var wrpd=el.wrap(wrp).parents();
				var $lbl=jQuery('<div id="lbl" style="'+(edit?'display:none':' ')+'" class="col-md-20 col-xs-20">'+listLabel[i-1]+'</div>');
				$listLbl.push($lbl);
				var $elbl=jQuery('<input style="'+(!edit?'display:none':' ')+'" class="col-md-20 col-xs-20" value="'+listLabel[i-1]+'"> ');
				$listEditLbl.push($elbl);
				wrpd.append($lbl);
				wrpd.append($elbl);
				jQuery($elbl).on('change',(function(v){var myi=v;return function(){
							listLabel[myi-1]=jQuery($elbl).val()
							state.edited=true
							state.lastEditEdited=true;
					}})(i));
				jQuery(el).on('click',
					(function(v){
						var myi=v;
					return function(){
						
						listValueFormated[myi-1]=!listValueFormated[myi-1];
						this.className=(this.className.contains("default"))?"col-md-2 col-xs-2 label label-primary":"col-md-2 col-xs-2 label label-default";
						console.log(listValueFormated);
					}})(i));
				arr.push(wrpd);			
			}						
			l.append(arr.slice(0,(listLabel.length+1)/2));
			r.append(arr.slice((listLabel.length+1)/2,listLabel.length));
			this.append(l,r);
		}
		this.reval=function(){

		}
		this.getListValue=function(){
			return listValueFormated;
		}

		this.addNewItem=function(val,edit){
			state.lastEditEdited=true;
			state.edited=true;
			var val=val||"test";
			console.log(val);
			listLabel.push(val);
			listValueFormated.push(false);
			this.init(listLabel,listValueFormated,edit);
		
		}
		this.removeLastItem=function(edit){
			state.edited=true;
			state.lastEditEdited=true;
			listLabel.pop();
			listValueFormated.pop();
			this.init(listLabel,listValueFormated,edit);

		}
		this.getRealListValue=function(){

			var i=1;
			var str=",";
			for(var b of listValueFormated){
				if(b){
					str+=i+",";
				}
				i++;
			}console.log(listValueFormated)
				console.log(str)
			return str;
		}

		this.getListLabel=function() {
			return listLabel;
		}
		this.isEdited=function(){
			return state.edited;
		}
		this.edit=function(){
			state.lastEditEdited=false;
			
			config.onOpenEdit(this);
			for(var i in $listLbl){
				$listLbl[i].hide();
				$listEditLbl[i].show();
			}
		}
		this.confirmEdit=function(){
			listLabel=[];
			for(var i in $listLbl){
				listLabel.push($listEditLbl[i].val())
				$listLbl[i].text($listEditLbl[i].val())
				$listLbl[i].show();
				$listEditLbl[i].hide();
			}
			
			for(var l of selesaiEditListener){
				l(state);
			}
		}
		this.addEventSelesaiEditListener=function(lis){
			selesaiEditListener.push(lis);
		}
		this.removeEventSelesaiEditListener=function(lis){
			var i=selesaiEditListener.indexOf(lis);
			selesaiEditListener.splice(i,1);
			console.log(selesaiEditListener)
		}
		
		this.init(listLabel,listValueFormated);
		return this;
	}
});
jQuery.fn.extend({
  AhmPasswordSystem:function(configArgs){
    var isShow=false;
    var config={
      redirect:configArgs.redirect,
      init:configArgs.init,
      ajaxUserName:configArgs.ajaxUserName,
    }
    var me=this;
    var strHtm=jQuery('<table class="table-responsive" width="50%">\
            <tr >\
              <td colspan="4">User Name</td>\
              <td >:</td>\
              <td align="left" colspan="7"">\
                <input type="text" class="form-control" value="" name="user_name" autocomplete="off" placeholder="user name...">\
              </td>\
            </tr>\
            <tr>\
              <td colspan="4">Password</td>\
              <td >:</td>\
              <td  align="left" colspan="7">\
                <input type="password" class="form-control" value="" autocomplete="off" name="user_password" placeholder="password...">\
              </td>\
              <td colspan="2"></td>\
            </tr>\
             <tr >\
              <td colspan="4">Email</td>\
              <td colspan="1" >:</td>\
              <td align="left" colspan="7">\
                <input type="text" class="form-control" value="" autocomplete="off" name="email" placeholder="email...">\
              </td>\
            </tr>\
            <tr>\
              <td colspan="4"></td>\
              <td>\
              </td>\
            </tr>\
            <tr>\
              <td colspan="5"></td>\
            </tr>\
            <tr>\
              <td colspan="5"></td>\
            </tr>\
          </table>');
    var pwd=' <table class="table-responsive"  width="50%"><tr >\
              <td colspan="4">Password Lama</td>\
              <td >:</td>\
              <td align="left" colspan="7"">\
                <input type="text" class="form-control" name="old_password" value="" autocomplete="off" placeholder="old password...">\
              </td>\
            </tr>\
            <tr >\
              <td colspan="4">Password Baru</td>\
              <td >:</td>\
              <td align="left" colspan="7"">\
                <input type="text" class="form-control" name="user_password" value="" autocomplete="off" placeholder="new password...">\
              </td>\
            </tr>\
            </table>';
    var strHtm2=jQuery('<table class="table-responsive" width="50%">\
            <tr >\
              <td colspan="4">User Name</td>\
              <td colspan="1" >:</td>\
              <td align="left" colspan="7">\
                <input type="text" class="form-control" name="user_name" value="" autocomplete="off" placeholder="user name...">\
              </td>\
            </tr>\
             <tr >\
              <td colspan="4">Email</td>\
              <td colspan="1" >:</td>\
              <td align="left" colspan="7">\
                <input type="text" class="form-control" name="email" value="" autocomplete="off" placeholder="email...">\
              </td>\
            </tr>\
            <tr>\
              <td colspan="4">Password</td>\
              <td >:</td>\
              <td  align="left" colspan="7">\
                <button  type="button" class="btn btn-primary" id="chng-pwd" >ubah password</button>\
              </td>\
            </tr>\
          </table>');;
    var rem='<input type="hidden" name="remove" value="true">';
    this.after('<input type="hidden" name="redirect" value="'+config.redirect+'">');
    var editPassword=jQuery('<input type="hidden" name="edit_password" value="false">');
    this.after(editPassword);
    var con=jQuery('<div>');
    var load=jQuery('<td style="display:none"><i  class="fa fa-spin fa-refresh refresh-float"></i></td>');
    var inf="w"
    var sama=false;
    this.after(con);
    con.hide()
    this.on('click',function(){
      
      jQuery(this).empty();
      isShow=!isShow;
      if(isShow){
        jQuery(this).append('<span class="fa fa-minus"></span><b> Remove Account</b>')
        con.empty();
        con.append(strHtm);
        var inpun=jQuery(con).deepest()[0]
        jQuery(inpun).parent().after(load)
        jQuery(inpun).on('input propertychange',function(e){
          var mei=this;
          if(this.value.length>1){
            console.log(this.value)

            jQuery.ajax({
              url:config.ajaxUserName+'/'+this.value,
              success:function(res,sts,xhr){
                          console.log(res)
                          if(res){
                            jQuery(mei).addClass('inp-warn')

                          }
                          else{
                            jQuery(mei).removeClass('inp-warn')
                          }
                        }
            })
         }
        });
        con.show()
      }else{
        jQuery(this).append('<span class="fa fa-plus"></span><b> Add Account</b>')
        con.empty()
        con.append(rem);
        con.hide()
      }

    });
    if(!(config.init===undefined)){
      jQuery(this).empty();
      isShow=true;
      
      this.append('<span class="fa fa-minus"></span><b> Remove Account</b>')

      con.empty();
      con.append(strHtm2);
      var inpun=jQuery(con).deepest()[0]
      var inpun2=jQuery(con).deepest()[1]
      inpun.value=config.init.username;
      inpun2.value=config.init.email;
      jQuery(inpun).parent().after(load)
      jQuery(inpun).on('input propertychange',function(e){
        var mei=this;
        if(this.value.length>1){
          console.log(this.value)

          jQuery.ajax({
            url:config.ajaxUserName+'/'+this.value,
            success:function(res,sts,xhr){
                        console.log(res)
                        if(res){
                          jQuery(mei).addClass('inp-warn')
                          sama=true;
                        }
                        else{
                          jQuery(mei).removeClass('inp-warn');
                          sama=false;
                        }
                      }
          })
       }
      });
      jQuery('#chng-pwd').on('click',function(e){
        con.append(pwd);
        jQuery(editPassword).val(true);
      });
      con.show()
    }else{
      this.append('<span class="fa fa-plus"></span><b> Add Account</b>')
      con.empty()
      con.append(rem);
      con.hide()
    }
    jQuery(document).ajaxStart(function () {
        //console.log("ajaax started")
          load.show();
        }).ajaxStop(function () {
          //console.log("ajaax stoped")
          load.hide();
    });
    jQuery("form").submit( function(eventObj) {
      if(sama)
        return false

     return true;
    });
  }
})
$.fn.extend({
    AhmMessagerList:function(configArgs,dataArgs,countArgs){
        var config={
            ajaxUrl:configArgs.ajaxUrl,
            showMore:configArgs.showMore||'#',
        }
        //data /title/deskripsi/readed/inbox_date
        var data=(dataArgs==undefined?[]:dataArgs);
        var json=[];
        var ico=jQuery('<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>');
        var load=jQuery('<span style="display:none;color:#000;text-align:center"  class="fa fa-spin fa-refresh fa-5x"></span>');
       
        var me=this;
        

        var mdia ='<div class="media-body"></div>';
        var ttle= '<p class="media-heading"></p>';
        var tm=  '<p class="small text-muted"><i class="fa fa-clock-o"></i></p>';                         
        var unread='<span class="fa fa-eye unread__badge"></span>';
        var readmore=$('<a href="'+config.showMore+'">\
                       <span >Baca Lainya...</span>\
                    </a>');

        var wrp1=jQuery('<li class="message-preview"></li>');
        var wrp2='<a href="#"></a>';
        var wrp3='<div class="media"></div>';
        me.append(wrp1);
        readmore.on('click',function(){
            console.log('read more...')
        })

        function clickMdiai(){

        }
        function initItem(json){
            
            if(json.length==0){
                wrp1.append( '<li>\
                           <a href="#">Tidak ada Pesan...</a>\
                        </li>');
            }
            else{

            for(msg of json){
                var mdiai= $(mdia);
                
                var ttlei=$(ttle);
                ttlei.append('<strong>'+msg.title+'</strong>');
                var tmi=$(tm);
                tmi.append($().perbedaanWaktuDenganSekarang(msg.event_date)+" <br> "+msg.event_date);
				
                mdiai.append(ttlei);
                mdiai.append(tmi);
                mdiai.append('<p>'+msg.deskripsi+'</p>')
               
                var wrp2i=$(wrp2);
                var wrp3i=$(wrp3);
                $(wrp3i).append(mdiai);
                $(wrp2i).append(wrp3i);
                $(wrp1).append(wrp2i);
                if(!(msg.readed==true)){
                    wrp2i.prepend(unread);
                    wrp2i.addClass('bg-hanura');
                };            
            }
            wrp1.append( '<li class="divider"></li>');
            wrp1.append(readmore);    
            }
            
        }

        ico.on('click',function(e){
            wrp1.empty();
            wrp1.append(load);
            $.ajax({
                url:config.ajaxUrl,
                success:function(res,sts,xhr) {
                    console.log(res)
                    json=JSON.parse(res);

                    initItem(json);
                }
            })
        })
        this.before(ico);
        jQuery(document).ajaxStart(function (e) {
        	//e.stopImmediatePropagation()
            //console.log("ajaax started")
            load.show();
        }).ajaxStop(function (e) {
            //console.log("ajaax stoped")
           // e.stopImmediatePropagation()
            load.hide();
        });
        if(countArgs>0){
            this.before('<span class="button__badge">'+countArgs+'</span>')
        }
    }       
});
$.fn.extend({
	QuickBox2:function(){
		this.show=function(){

		}
}});
$.fn.extend({
    AhmTemplateList:function(configArgs,dataArgs,countArgs){
        var config={
            ajaxUrl:configArgs.ajaxUrl,
            itemKeys:configArgs.itemKeys,
            template:(configArgs.template===undefined?'<li><a href="#">{HTML}</a></li>':configArgs.template),
            onItemSelected:(configArgs.onItemSelected===undefined?function(){}:configArgs.onItemSelected),
            onRenderValue:(configArgs.onRenderValue===undefined?function(){return false;}:configArgs.onRenderValue),
            limitList:(configArgs.limitList===undefined?5:configArgs.limitList),
            useScrollLoad:(configArgs.useScrollLoad===undefined?true:configArgs.useScrollLoad),
            useLimit:(configArgs.useLimit===undefined?true:configArgs.useLimit),
            selected:(configArgs.selected?configArgs.selected:0),
            poss:configArgs.poss||'right',
            footerMenu:configArgs.footerMenu,
            onRenderItemDone:(configArgs.onRenderItemDone?configArgs.onRenderItemDone:function(){console.log('unimplement')}),
        }
        //data /title/deskripsi/readed/inbox_date
        if(config.itemKeys===undefined)
        throw 'item Keys Belum Ditentukan!!';

        var data=(dataArgs==undefined?[]:dataArgs);
        var json=[];
        var menuCon = jQuery('<div  class="dropdown-menu pull-'+config.poss+' "><div>')
        var drpMenu=jQuery('<ul style="padding:0">\
							</ul>');
 		var footerMenu;
 		var drpMenuCon=jQuery('<div class="ahm-template-list-menu ">');
		

        //jQuery(drpMenu).perfectScrollbar('update');  
        var load=jQuery('<div style="display:none;color:#000;text-align:center" ><span  class="fa fa-spin fa-refresh fa-5x"></span></div>');
        var load2=jQuery('<span style="display:none;color:#000;text-align:right"  class="fa fa-spin fa-refresh fa-2x"></span>');

        var me=this;
        var curScroll=0;
       	var splitTpl=config.template.split(/\{([^}]+)\}/);
       	var oriJson=[];
        var currListTot=0;
        var divider=jQuery('<li class="divider"></li>');
        var notFound=jQuery( '<li style="text-align:center; list-style-type: none">\
                           <b >akhir data...</b>\
                        </li>');
        var reachedLastData=false;
        var selected;
        me.after(menuCon);
        drpMenuCon.append(drpMenu)
        menuCon.append(drpMenuCon)
        

        if(config.footerMenu){
	        footerMenu=$(config.footerMenu);
	        footerMenu.on('click',function(e){
	        	e.stopPropagation();

	            reqAjax()
	        })
	        menuCon.append(footerMenu)
    	}
        drpMenuCon.isScrolledToBottom(function(){
        	load2.show()
        	
        	reqAjax();
        });
       /* Ps.initialize(drpMenu[0], {
		  wheelSpeed: 2,
		  wheelPropagation: true,
		  minScrollbarLength: 20,
		  zIndex:2,
		});*/
		jQuery(drpMenuCon).slimScroll({
		    railVisible: true,
		    railOpacity: 0.3,
		    wheelStep: 2,
		       touchScrollStep:10,
		});
        var reqAjax=(function(){
        	var allowReq=true;
        	return function(){
	        	if (!reachedLastData)
	        	if(allowReq){
	        		currScroll=drpMenuCon.scrollTop();
	        		allowReq=false;
		        	$.ajax({
		                url:(config.useLimit?config.ajaxUrl+"/"+currListTot+"/"+config.limitList:config.ajaxUrl),
		                success:function(res,sts,xhr) {
		                    //console.log(res)

		                    json=JSON.parse(res);
		                    initItem(json);
		                    currListTot+=6;
		                    
		                   
							drpMenu.scrollTop(currScroll);
							//Ps.update(drpMenuCon[0])
					        allowReq=true;
		                },
		            });
		        }
    		}
        })();
        function clickMdiai(){

        }
        function initItem(json){
            oriJson=json;
            if(json.length==0){
            	reachedLastData=true;
        		drpMenu.append(notFound)
            }
            else{
	        	var temp="";
	            for(dt of json){
	            	var tplRes="";
			       	
			     	for(var s of  splitTpl){
			     		var idx=0;
			     		for(a of config.itemKeys){
			     			if(s===a){
			     				
			     				var res;    				
			     				if(res=config.onRenderValue(a,dt[a]))
			     					tplRes+=res;
			     				else tplRes+=dt[a];
			     				idx++;

			     				break;
			     			}
			     			if(idx===config.itemKeys.length-1)
			     				tplRes+=s;
			     			idx++;
			     		}

			     	}

			     	var tpli=jQuery(tplRes)
			     	tpli.on('click',(function(dt){

			     		var dtx=dt;
			     		return function(e){selected=dt;config.onItemSelected(dtx)};
			     	})(dt));
			     	drpMenu.append(tpli);
			     	config.onRenderItemDone()
			     } 
	             
	            drpMenu.append(load);  
            }      
        }
        this.getSelected=function(){
        	return selected;
        }
      	this.on('click',function(e){
      		reachedLastData=false;
            drpMenu.empty();
            currListTot=0;
            currScroll=drpMenuCon.scrollTop();
            drpMenu.append(load); 
            $.ajax({
                url:(config.useLimit?config.ajaxUrl+"/"+currListTot+"/"+config.limitList:config.ajaxUrl),
                success:function(res,sts,xhr) {
                    //console.log(res)
                    json=JSON.parse(res);

                    initItem(json);
                    drpMenuCon.scrollTop(currScroll)
                    currListTot+=6;
                   // Ps.update(drpMenuCon[0]);
                },
            });
        });
        
        jQuery(document).ajaxStart(function (e) {
        	//e.stopImmediatePropagation()
            //console.log("ajaax started")
            load.show();
            load2.show()
        }).ajaxStop(function (e) {
            //console.log("ajaax stoped")
           // e.stopImmediatePropagation()
           	load.hide();
            load2.hide()
        });
      return this;
    }       
});

jQuery.fn.extend({
	QuickBox:(function(){
	var obj={};
	return function(par,txt){
		
		var msg=jQuery('<div class="panel" style="padding:20px !important;border:1px solid #000;position:absolute;z-index:10;background:#F3EDDC"><div class="row"><span style="cursor:pointer;float:right" class="fa fa-times-circle"></span>'+txt+'<input type="text" class="form-control">\
			</input></div><div class="row"><button class="btn btn-primary" type="button">Buat Template Title</div></div>');
		var key;
		msg.on('click','span',function(){
			console.log("close quick")
			delete obj[key];
			msg.remove()
		})
		msg.on('click','button',function(){
			msg.remove()
		})
		msg.on('change','input',function(){
			obj[key]=jQuery(this).val();
			console.log(obj[key])
		});
		this.set=function(keya,vala){
			var val = vala || "";
			console.log(val)
			obj[key]=val;
			key=keya;
		}
		this.get=function(key){
			msg.remove()
			//if(!obj[key]) throw 'tidak ada key terdefinisi!!';
			return obj[key];
		}
		this.show=function(){
			jQuery(par).append(msg)
			return this;
		}
		return this;
	}
})()});
