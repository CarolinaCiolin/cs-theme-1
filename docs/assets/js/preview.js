var $=function(s,c){return[].slice.call((c||document).querySelectorAll(s))};
addEventListener('scroll',function(){var h=document.documentElement;document.getElementById('pg').style.width=(h.scrollTop/(h.scrollHeight-h.clientHeight)*100)+'%'},{passive:true});
var io=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('on');if(e.target.id=='fg')e.target.classList.add('go');io.unobserve(e.target)}})},{threshold:.15});
$('.rv,#fg').forEach(function(e){io.observe(e)});
var co=new IntersectionObserver(function(es){es.forEach(function(e){if(!e.isIntersecting)return;var el=e.target,n=+el.dataset.n,t=0;var i=setInterval(function(){t+=1;el.textContent=Math.round(n*Math.min(t/30,1));if(t>=30)clearInterval(i)},30);co.unobserve(el)})});
$('[data-n]').forEach(function(e){co.observe(e)});
$('.tb').forEach(function(b){b.onclick=function(){$('.tb').forEach(function(x){x.setAttribute('aria-selected',x==b)});$('.tp').forEach(function(p){p.classList.toggle('on',p.id==b.getAttribute('aria-controls'))})}});
var tr=document.getElementById('tr'),sl=$('blockquote',tr),dt=document.getElementById('dt');
sl.forEach(function(){dt.appendChild(document.createElement('i'))});
function cur(){var w=sl[0].offsetWidth+18;return Math.min(sl.length-1,Math.round(tr.scrollLeft/w))}
function upd(){var c=cur();$('i',dt).forEach(function(d,i){d.classList.toggle('on',i==c)})}
function go(d){var w=sl[0].offsetWidth+18,n=cur()+d;if(n<0)n=sl.length-1;if(n>=sl.length)n=0;tr.scrollTo({left:n*w,behavior:'smooth'})}
tr.addEventListener('scroll',upd,{passive:true});upd();
document.getElementById('pv').onclick=function(){go(-1)};document.getElementById('nx').onclick=function(){go(1)};
$('.chip').forEach(function(c){c.onclick=function(){$('.chip').forEach(function(x){x.setAttribute('aria-pressed',x==c)});$('.plan').forEach(function(p){p.hidden=c.dataset.f!='all'&&p.dataset.c!=c.dataset.f})}});
$('form.f').forEach(function(f){f.addEventListener('submit',function(ev){ev.preventDefault();var d=new FormData(f);location.href='mailto:biomechanik.wimmersberger@gmail.com?subject='+encodeURIComponent('Gratis-Coaching Anfrage')+'&body='+encodeURIComponent(d.get('m')+'\n\n'+d.get('n')+' ('+d.get('e')+')')})});