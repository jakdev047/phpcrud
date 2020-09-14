document.addEventListener('DOMContentLoaded',function(){
    var links = document.querySelectorAll('.delete');

    for (let i = 0; i < links; i++) {
        let element = links[i];
        element.addEventListener('click',function(e){
            if(confirm('Are Your Sure')) {
                e.preventDefault();
            }
        })
        
    }

})