let arr = [4,3,1,0,1,3,4]

function isPalidrome(array){


  for(let i=0 ; i < array.length ; i++){

    if(array[i] != array[ array.length -1 - i]){

      return false
      break
    }

    
  }
  return true

}

  // console.log(isPalidrome(arr))

  function upsetdown(w){
    let word = ''
    for(i=w.length-1 ; i >= 0 ; i--){

      word  = word + w[i]

    }
    //  join = word.join('')
    return word

  }

  // let test = 'hamza'
  // console.log(upsetdown(test))

  function ispalycharacter(word){

    let loop = Number.parseInt(word.length/2)
    let p = word.length-1
    for(let i = 0 ; i < loop ; i++){

      if(word[i] != word[p]){
        return false

      }
      p--
      
    }
    return true
  }

  // let o = 'racar'
  // console.log(ispalycharacter(o))

  function countvowels(word){
    let count  = 0
    for(let i = 0 ; i < word.length ; i++){
      if(word[i] === 'a' || word[i] === 'i'||word[i] === 'o'||word[i] === 'y'||word[i] === 'u'){
        count++
      }

    }
    return count

  }
  // word = 'zakaria'
  // console.log(countvowels(word))

  function firstTOUpperCase(word){

    for(let i = 0 ; i < word.length ; i++){
      if(i==0){
        // console.log('hh')
        word[i].toUpperCase()
      }
      if(word[i] == " "){
        // console.log('hh')
        
        word[i+1].toUpperCase() 
      }
    }
    return word
  }

  let word= "hello world"
  console.log(firstTOUpperCase(word)) 
