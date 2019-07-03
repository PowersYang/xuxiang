
    <a href="javascript:sall()">全选</a>
    <a href="javascript:fall()">反选</a>
    <a href="javascript:nall()">全不选</a>
    
<script>
	var cnames=document.getElementsByName("ids[]");
		
	function sall(){
		for(var i=0; i<cnames.length; i++)
				cnames[i].checked="true";
			
		}

	function fall(){
		for(var i=0; i<cnames.length; i++)
			if(cnames[i].checked)
					cnames[i].checked="";
				else
					cnames[i].checked="true";
					
		}

	function nall(){
		for(var i=0; i<cnames.length; i++)
			cnames[i].checked="";
		}
</script>
