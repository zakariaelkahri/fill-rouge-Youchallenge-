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

  console.log(isPalidrome(arr))