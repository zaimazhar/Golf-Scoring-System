console.log("Hello World");

function venueDeleteConfirmation(vname, vid) {
    let vname_store = prompt(`Type ${vname} 
    to delete`)

    if(vname_store === vname) {
        let deleteForm = new XMLHttpRequest()
        deleteForm.open("GET", `http://golf_score_system.io/posts/venue_delete?vid=${vid}`)
    } else {
        console.log("You SUCKS")
    }
}