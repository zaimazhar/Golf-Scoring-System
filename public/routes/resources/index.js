console.log("Hello World");

function venueDeleteConfirmation(vname, vid) {
    let vname_store = prompt(`Type '${vname}' to delete`)

    if(vname_store === vname) {
        let deleteForm = new XMLHttpRequest()

        deleteForm.open("POST", "http://golf_score_system.io/posts/venue_delete")
        deleteForm.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        deleteForm.onreadystatechange = function() {
            if(this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                let dataRespond = JSON.parse(deleteForm.response)
                setTimeout(function() { location.reload() }, 1000)
                alert(`Successfully deleted: ${dataRespond.venue_name}`)
            }
        }
        deleteForm.send(`id=${vid}`)
    } else {
        console.log("You SUCKS")
    }
}