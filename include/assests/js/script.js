
const admin =document.querySelector('.admin');
const role =document.querySelector('#user_role').textContent;


if(role==='admin'){
    admin.style.display= 'block';
}else{
    admin.style.display= 'none';
}
