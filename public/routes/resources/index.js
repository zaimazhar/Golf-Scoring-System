console.log("Hello World");

function venueDeleteConfirmation(vname, vid) {
    vname = prompt(`Type ${vname} 
    to delete`)
    let deleteForm = new XMLHttpRequest()
    deleteForm.open("GET", `http://golf_score_system.io/posts/venue_delete?vid=${vid}`)


}