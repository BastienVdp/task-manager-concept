export const replaceDate = (dateString) => {
    const date = new Date(dateString)
    return date.getDate()+ "/"+(date.getMonth()+1)+ "/"+date.getFullYear()
}
