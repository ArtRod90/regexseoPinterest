!function(){const t=document.querySelectorAll(".make"),o=document.querySelectorAll(".ban");console.log(o);for(let o=0;o<t.length;o++){const n=t[o];n.addEventListener("click",(function(){Swal.fire({title:"Do you want to make this user an editor?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Make it!"}).then(t=>{if(t.isConfirmed){e(n.dataset.id)}})}))}for(let t=0;t<o.length;t++){const e=o[t];e.addEventListener("click",(function(){Swal.fire({title:"Do you want to ban this user??",text:"You will not be able to reverse this action!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Make it!"}).then(t=>{if(t.isConfirmed){n(e.dataset.id)}})}))}async function e(t){const o=new FormData;o.append("id",t);try{const t="http://localhost:3000/api/editor",e=await fetch(t,{method:"POST",body:o}),n=await e.json();if(swal.fire({title:n.mensaje,icon:n.tipo}),"success"===n.tipo){document.querySelector("#C"+n.id).remove()}}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}async function n(t){const o=new FormData;o.append("id",t);try{const t="http://localhost:3000/api/ban",e=await fetch(t,{method:"POST",body:o}),n=await e.json();if(swal.fire({title:n.mensaje,icon:n.tipo}),"success"===n.tipo){document.querySelector("#C"+n.id).remove()}}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}}();