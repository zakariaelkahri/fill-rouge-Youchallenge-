let products =

    [
        {
            id: 1,
            name: 'pc',
            price: 1040
        },
        {
            id: 2,
            name: 'brush',
            price: 13
        },
        {
            id: 3,
            name: 'phone',
            price: 500
        }

    ]


function display(obj) {

    let dd = obj.length

    return products


}



function ajouterProduit(nom, prix) {

    let last_element = products.length+1
          let obj =
           {
                id: last_element,
                name: nom,
                price: prix
           }

           products.push(obj)
    return 

}
    ajouterProduit('A', 100)
    ajouterProduit('b', 100)
    ajouterProduit('A', 200)
 
    function rechercherProduit(nom){

        for(let i = 0 ; i<products.length; i++){
            if(products[i].name == nom)
            {
                return products[i]

            }
        }
            
        return null

    }



function modifierPrix(id, nouveauPrix){

    for(let i = 0 ; i<products.length; i++){
        if(products[i].id == id)
        {
            products[i].price = nouveauPrix

        }
    }
        
    return null

}

modifierPrix(3, 340)

function supprimerProduit(id){

    for(let i = 0 ; i<products.length; i++){
        if(products[i].id == id)
        {
            // products.splice(i,1)
            return products = products.filter(product => product.id !== id)

        }

    }
        
    return null

}

    supprimerProduit(5)

    function afficherProduits(){


           for(let i = 0 ; i<products.length; i++)
            {

                console.log(products[i])

            }


    }

    // console.log( afficherProduits())

    function filtrerProduitsParPrix(minPrix){

        products = products.filter(product => product.price >= minPrix)

        return products

    }

    // console.log(filtrerProduitsParPrix(100))

    function statistiquesProduits(){

        let abrTotal = products.length
        let productspluscher = 0
        let avrgprice = 0

        for(let i = 0 ; i <products.length ; i++){

            if(productspluscher < products[i].price){

                productspluscher = products[i].price
            }

            avrgprice = avrgprice + products[i].price           

        }

        avrgprice = (avrgprice)/products.length    

        return [abrTotal,productspluscher,avrgprice] 

    }

    // console.log(statistiquesProduits())

    function trierProduitsParNom(){

        let s 

        for(let i = 0 ; i <products.length ; i++){

            for(let j = 0 ; j <products.length-1 ; j++){

                if(products[j].name > products[j+1].name ){

                    s = products[j+1]
                    products[j+1] = products[j]
                    products[j] = s
                }
            }

        }
        return products

    }
     
        // console.log(trierProduitsParNom())

        function trierProduitsParPrix(desc = true){

            for(let i = 0 ; i <products.length ; i++){

                for(let j = 0 ; j <products.length-1 ; j++){
    
                    if(products[j].price < products[j+1].price ){
    
                        s = products[j+1]
                        products[j+1] = products[j]
                        products[j] = s
                    }
                }
    
            }
            return products
        }

        // console.log(trierProduitsParPrix())


        // -----------------------------------------------------------------------
        // mini tp


        // id, client, produit, quantité, statut

        let commandes = [
            {
                id: 1,
                client: 'Zakaria El Kahri',
                produit: 'Riz basmati',
                quantitie: 2,
                statut: 'validated'
            },
            {
                id: 2,
                client: 'Fatima Zahra Bennani',
                produit: 'Huile d\'olive',
                quantitie: 1,
                statut: 'rejected'
            },
            {
                id: 3,
                client: 'Youssef Amrani',
                produit: 'Lait entier',
                quantitie: 6,
                statut: 'en attente'
            }
        ];
        ;

        
        function addCommand( client, produit, quantitie){

            id = commandes.length+1 
            let newcommand = {
                id: id,
                client: client,
                produit: produit,
                quantitie: quantitie,
                statut: 'en attente'
            }

            commandes.push(newcommand)

        }

        addCommand( 'client', 'produit', 3)

    // console.log(commandes)

    function validateCommand(id){

        for(let i = 0 ; i<products.length; i++){
            if(commandes[i].id == id)
            {

                return commandes[i].statut = 'validated'
    
            }
    
        }
        return null

    }

    // validateCommand(4)



    function rejectCommand(id){

        for(let i = 0 ; i<products.length; i++){
            if(commandes[i].id == id)
            {

                return commandes[i].statut = 'rejected'
    
            }
    
        }
        return null

    }

    // rejectCommand(3)

    // console.log(commandes)


    function search(name){

        for(let i = 0 ; i<products.length; i++){
            if(commandes[i].name == name)
            {

                return commandes[i]
    
            }
    
        }
        return null

    }

    console.log('holla') 

