let arr = [4, 3, 1, 0, 1, 3, 4]

function isPalidrome(array) {


  for (let i = 0; i < array.length; i++) {

    if (array[i] != array[array.length - 1 - i]) {

      return false
      break
    }


  }
  return true

}

// console.log(isPalidrome(arr))

function upsetdown(w) {
  let word = ''
  for (i = w.length - 1; i >= 0; i--) {

    word = word + w[i]

  }
  //  join = word.join('')
  return word

}

// let test = 'hamza'
// console.log(upsetdown(test))

function ispalycharacter(word) {

  let loop = Number.parseInt(word.length / 2)
  let p = word.length - 1
  for (let i = 0; i < loop; i++) {

    if (word[i] != word[p]) {
      return false

    }
    p--

  }
  return true
}

// let o = 'racar'
// console.log(ispalycharacter(o))

function countvowels(word) {
  let count = 0
  for (let i = 0; i < word.length; i++) {
    if (word[i] === 'a' || word[i] === 'i' || word[i] === 'o' || word[i] === 'y' || word[i] === 'u') {
      count++
    }

  }
  return count

}
// word = 'zakaria'
// console.log(countvowels(word))

function firstTOUpperCase(word) {
  let test = ""
  for (let i = 0; i < word.length; i++) {
    if (i === 0) {
      console.log(word[i])
      test += word[i].toUpperCase()
      console.log(word[i])

    } else if (word[i] == " ") {

      test += word[i].toUpperCase()

    } else {
      test += word[i].toUpperCase()

    }

  }
  return test
}

let wor = "hello world"
// console.log(firstTOUpperCase(wor))
// console.log( wor[0].toUpperCase())

// if(i==0){
//   console.log(word[i])
//   word[i] = word[i].toUpperCase()
//   console.log(word[i])
// }
// if(word[i] == " "){
//   // console.log('hh')

//   word[i+1].toUpperCase()
// }



let str = "oolla"
function count(str) {
  let unique = ""

  for (let i = 0; i < str.length; i++) {
    let isUnique = true
    let cnt = 0
    for (let j = 0; j < unique.length; j++) {

      if (str[i] === unique[j]) {
        isUnique = false
        break
      }

    }
    for (let j = 0; j < str.length; j++) {

      if (str[i] === str[j]) {
        cnt++
      }

    }

    if (isUnique === true) {
      unique += str[i] + cnt
    }
  }

  return unique

}
// console.log(count(str)) 



function remove(arr, e) {
  let s = 0
  for (let i = 0; i < arr.length; i++) {
    
    if (arr[i] === e) {
      for (let j = i; j < arr.length -1; j++) {
        
        s = arr[j + 1]
        arr[j + 1] = arr[j]
        arr[j] = s
        
        
      }
      arr.length -= 1
    }
  }
  return arr
}

// console.log(remove(array, 33)) 

let array = [4, 3, 1, 0, 1, 3, 4,2, 8, 1,5]
function firstLast(arr){

  let s = 0
  let p = arr.length-1 
  for(let i = 0 ;  i <= (arr.length-1)/2; i ++){
    console.log(arr)
     s = arr[i]
     arr[i] = arr[p]
     arr[p] = s
    
     p--

  }
  return arr
}

// console.log(firstLast(array)) 


// {
//   'passable' : [12],
//   'moyenne' : [20],
//   'bien' : [22],
// }


  //  let obj = {
     
  //    passable : [12],
  //    moyenne : [],
  //    bien : []
     
  //  }
  // // console.log(obj.passable)
  // let passable = 0
  //  let moyenne  = 0
  //  let bien = 0 
   
  //  for(let i = 0 ; i < arr.length ; i++){
     
  //   if(arr[i] >=10 && arr[i]  <= 12){
      
  //     passable ++
  //     obj.passable = passable  
  //   }else if(arr[i] >=12 && arr[i]  <= 16){
      
  //     moyenne ++
  //     obj.moyenne = moyenne  
  //   }else if(arr[i] >=16 && arr[i]  <= 20){
      
  //     bien ++
  //     obj.bien = bien  
  //   }
  
     
     
  //  }
   
  // return console.log(obj)


  // -------------------------------------------

  // let str =  "abc#abc ldfjbjio nes#jfjf dhudrg"

//   let finalstr = ""
//   for(let i =0 ; i < str.length ; i++){
     
//     let isHash = false
//     let prpr = ""
     
//     if(i == 0 || str[i] == " "){
       
//       for(let j =i+1 ; j < str.length ; j++){
         
//         if(str[j] == " "){
           
//           break
//         }else if(str[j] == "#"){
           
//           isHash = true
//         }
         
//         prpr += str[j]
         
         
//       }
//       if(isHash == true){
//       finalstr += prpr+" " 
//       }
//     }
     
//   }
   
//   console.log(finalstr) 


// ---------------------------------------------
// let ar = [1,2,3,4,5,3,1 ]
// let ar2 =[1,2,3,4]

// function test(arr,arr2){
// let empty = []
// // let pointer 
// let bool = true

// for(let i=0 ; i < arr.length ; i++){
  
//   if(arr[i] == arr2[0]){
//   empty = [];
//   for(let j=0 ; j < arr2.length ; j++){
//     if(arr2[j] != arr[i]){
      
//       bool = false
//       i = i - j
//       break
//     }else{
//       bool = true
//       empty.push(arr[i])
//       i++
//     if(arr2.length === empty.length){
//     return bool
//   }
//     }
    
 
//   }

//   }
// }
//   return bool
// //   console.log(arr2 , empty)
// // console.log(bool)
//   }

// console.log(test(ar,ar2))

// -----------------------------------------------------












  
   


