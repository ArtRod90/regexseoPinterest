!function(){let t=0,e=[];!async function(){try{const o="http://localhost:3000/admin/carga",n=await fetch(o,{method:"POST"}),i=await n.json();if(e=i.fotos,todosusuarios=i.todosusuarios,i.fotos.length>20){t=1;const o=document.querySelector("#btntcarga");o.addEventListener("click",(function(n){!function(){for(let o=20*t;o<e.length;o++){const t=e[o];let n,i,a,l,c,s=document.createElement("div"),d="";for(let e=0;e<todosusuarios.length;e++){const o=todosusuarios[e];o.id===t.usersid&&(n=`<a href="#" class="card-text">${o.name} ${o.email}</a>`,i=`<p class="card-text">No. Warnings: ${o.advertencias}</p>`,c=o.id)}"N"===t.aprobado?(a="btn btn-danger",l="Not approved",d=`<form  action="/adminconcurso" method="POST">\n    <input id="B${t.id}" data-id="${t.id}" type="submit"class="aprobar btn btn-primary mt-2" value="Approve">\n    </form>`):(a="btn btn-success",l="Not approved"),s.innerHTML=`\n              \n                  <div id="C${t.id}" style="width: 18rem; height: auto;" >\n                 <img src="${t.url}" class="foto card-img-top img-fluid img-thumbnail" alt="foto"">\n                 <div class="card-body">\n                   <h4 id="A${t.id}" class="${a}">${l}</h4>\n                   <h5 class="card-title">${t.Titulo}</h5>\n                   ${n}\n                   ${i}\n                 </div>\n                 <div class="card-footer">\n                 ${d}       \n                   <button data-id="${t.id}" data-idusuario="${c}"\n                    class="borrar btn btn-danger mt-3" >Delete</button>\n                    \n                 </div>\n               </div>\n              `,r.appendChild(s)}}(),async function(){let e=document.querySelectorAll(".aprobar"),o=document.querySelectorAll(".borrar"),n=document.querySelectorAll(".foto");for(let t=0;t<e.length;t++){const o=e[t];o.removeEventListener("click",(function(t){t.preventDefault();let e=o.dataset.id;Swal.fire({title:"Do you want to approve this image?",text:"You will not be able to reverse this action!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Approve it!"}).then(t=>{t.isConfirmed&&a(e)})}))}for(let t=0;t<e.length;t++){const o=e[t];o.addEventListener("click",(function(t){t.preventDefault();let e=o.dataset.id;Swal.fire({title:"Do you want to approve this image?",text:"You will not be able to reverse this action!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Approve it!"}).then(t=>{t.isConfirmed&&a(e)})}))}for(let e=20*t;e<o.length;e++){const t=o[e];t.addEventListener("click",(function(e){e.preventDefault();let o=t.dataset.id,n=t.dataset.idusuario;Swal.fire({title:"Do you want to delete this image?",text:"You will not be able to reverse this action!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, remove it!"}).then(t=>{t.isConfirmed&&l(o,n)})}))}for(let e=20*t;e<n.length;e++){const t=n[e];t.addEventListener("click",(function(e){Swal.fire({imageUrl:t.src,imageAlt:"foto"})}))}}(),setTimeout(()=>{t++,20*t>i.fotos.length&&o.remove()},500)}))}else if(btntcarga.remove(),i.fotos.length<=0){let t=document.createElement("p");t.textContent="There is no image yet",r.appendChild(t)}}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}();let o=document.querySelectorAll(".foto"),n=document.querySelectorAll(".aprobar"),i=document.querySelectorAll(".borrar");const r=document.querySelector(".fotosdash");for(let t=0;t<o.length;t++){const e=o[t];e.addEventListener("click",(function(t){Swal.fire({imageUrl:e.src,imageAlt:"foto"})}))}for(let t=0;t<n.length;t++){const e=n[t];e.addEventListener("click",(function(t){t.preventDefault();let o=e.dataset.id;Swal.fire({title:"Do you want to approve this image?",text:"You will not be able to reverse this action!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, Approve it!"}).then(t=>{t.isConfirmed&&a(o)})}))}for(let t=0;t<i.length;t++){const e=i[t];e.addEventListener("click",(function(t){t.preventDefault();let o=e.dataset.id,n=e.dataset.idusuario;Swal.fire({title:"Do you want to delete this image?",text:"You will not be able to reverse this action!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, remove it!"}).then(t=>{t.isConfirmed&&l(o,n)})}))}async function a(t){const e=new FormData;e.append("id",t);try{const t="http://localhost:3000/api/aprobar",o=await fetch(t,{method:"POST",body:e}),n=await o.json();if(swal.fire({title:n.mensaje,icon:n.tipo}),"success"===n.tipo){let t=document.querySelector("#A"+n.id),e=document.querySelector("#B"+n.id);t.textContent="Approved",t.classList.remove("btn-danger"),t.classList.add("btn-success"),e.remove()}}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}async function l(t,e){const o=new FormData;o.append("id",t),o.append("idusuario",e);try{const t="http://localhost:3000/api/eliminar",e=await fetch(t,{method:"POST",body:o}),n=await e.json();if(swal.fire({title:n.mensaje,icon:n.tipo}),"success"===n.tipo){let t=document.querySelector("#C"+n.id);console.log(t),t.remove()}}catch(t){console.log(t),swal.fire({title:"Error",icon:"error",showConfirmButton:!1,timer:2e3})}}}();