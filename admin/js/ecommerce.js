class Ecommerce
{


    constructor(){
        this.api_key = "API_KEY=adsffsdfds6b-6727-46f4-8bee-2c6ce6293e41";
        this.api = "http://localhost:8090/ecom/backend/api/";
        this.actions = ['orders', 'users','category','products'];
        this.data = [];
        this.initRouter();
        this.initDataApp();
    }

    initRouter(){
        this.actions.forEach((action)=>{
            document.getElementById(action).addEventListener('click', ()=>{
                fetch('templates/'+action+'.html')
                .then((response)=>{
                    if(response.ok){
                        return response.text();
                    }else{
                        console.log('Erreur de chargement du template');
                    }
                }).then((data)=>{
                    document.getElementsByClassName('container-fluid')[0].innerHTML = data;
                    if(action == 'products'){
                        this.loadProducts();
                    }else if(action == 'category'){
                        this.loadCategory();
                    }else if(action == 'users'){
                        this.loadUsers();
                    }else if(action == 'orders'){
                        this.loadOrders();
                    }
                })
            })
        })
    }

    initDataApp(){
        this.actions.forEach((action)=>{
            const url = this.api+action+"?"+this.api_key;
            fetch(url)
            .then((response)=>{
                if(response.ok){
                    return response.json();
                }else{
                    console.log("Erreur de chargement des données !");
                }
            }).then((data)=>{
                if(data.status == 200){
                    this.data.push({name: action, data:data.result})
                    // localStorage.setItem(action, JSON.stringify(data.result));
                }
            })
        })
    }

    getData(action){
        var object = this.data.find(element =>element.name === action);
        return object.data;
        // return JSON.parse(localStorage.getItem(entity)) ? JSON.parse(localStorage.getItem(entity)) : [];
    }

    loadProducts(){
        $('#dataTable').DataTable( {
            data: this.getData('products'),
            columns: [
                { data: 'idProduct' },
                { data: 'name' },
                { data: 'description' },
                { data: 'price' },
                { data: 'stock' },
                { data: 'createdAt' }
            ]
        } )
    }

    loadCategory(){
        $('#dataCat').DataTable( {
            data: this.getData('category'),
            columns: [
                { data: 'idCategory' },
                { data: 'name' }
            ]
        } )
    }

    loadUsers(){
        $('#dataUsers').DataTable( {
            data: this.getData('users'),
            columns: [
                { data: 'idUser' },
                { data: 'email' },
                { data: 'firstname' },
                { data: 'lastname' }
            ]
        } )
    }

    loadOrders(){
        $('#dataOrders').DataTable( {
            data: this.getData('orders'),
            columns: [
                { data: 'idOrder' },
                { data: 'idUser' },
                { data: 'idProduct' },
                { data: 'quantity' },
                { data: 'price' },
                { data: 'createdAt' }
            ]
        } )
    }

}




export { Ecommerce }