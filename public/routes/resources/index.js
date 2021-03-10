let column = document.querySelector("#column")

column.addEventListener("click", function() {
    let form_venue = document.querySelector("#form_venue")
    let div = document.createElement("div")
    let input_player_name = document.createElement("input")
    let input_player_handicap = document.createElement("input")
    input_player_name.setAttribute("type", "text")
    input_player_name.setAttribute("name", "player_name[]")
    input_player_name.placeholder = "Name"
    input_player_handicap.setAttribute("type", "number")
    input_player_handicap.setAttribute("name", "player_handicap[]")
    input_player_handicap.placeholder = "Handicap"
    div.appendChild(input_player_name)
    input_player_name.insertAdjacentElement("afterend", input_player_handicap)
    let last_div = form_venue.lastElementChild
    last_div.insertAdjacentElement("afterend", div)
})

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