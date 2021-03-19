let url = "http://golf_score_system.io"

function addColumn() {
    let form_venue = document.querySelector("#form_venue")
    let div = document.createElement("div")
    let input_player_name = document.createElement("input")
    let input_player_handicap = document.createElement("input")
    div.classList.add("form-inline")
    input_player_name.setAttribute("type", "text")
    input_player_name.classList.add("form-control")
    input_player_name.classList.add("mt-3")
    input_player_name.classList.add("mr-3")
    input_player_name.setAttribute("name", "player_name[]")
    input_player_name.placeholder = "Name"
    input_player_handicap.setAttribute("type", "number")
    input_player_handicap.setAttribute("name", "player_handicap[]")
    input_player_handicap.classList.add("form-control")
    input_player_handicap.classList.add("mt-3")
    input_player_handicap.classList.add("mr-3")
    input_player_handicap.placeholder = "Handicap"
    div.appendChild(input_player_name)
    input_player_name.insertAdjacentElement("afterend", input_player_handicap)
    let last_div = form_venue.lastElementChild
    last_div.insertAdjacentElement("afterend", div)
}

function stableford() {
    let form_stableford = document.querySelector("#sf")
    let div = document.createElement("div")
    let input_par = document.createElement("input")
    let input_point = document.createElement("input")
    div.classList.add("form-inline")
    input_par.setAttribute("type", "text")
    input_par.classList.add("form-control")
    input_par.classList.add("mt-3")
    input_par.classList.add("mr-3")
    input_par.setAttribute("name", "par[]")
    input_par.placeholder = "Par"
    input_point.setAttribute("type", "number")
    input_point.setAttribute("name", "point[]")
    input_point.classList.add("form-control")
    input_point.classList.add("mt-3")
    input_point.classList.add("mr-3")
    input_point.placeholder = "Point"
    div.appendChild(input_par)
    input_par.insertAdjacentElement("afterend", input_point)
    let last_div = form_stableford.lastElementChild
    last_div.insertAdjacentElement("afterend", div)
}

function team() {
    let form_team = document.querySelector("#form_venue_team")
    let div = document.createElement("div")
    let input_par = document.createElement("input")
    let input_point = document.createElement("input")
    div.classList.add("form-inline")
    input_par.setAttribute("type", "text")
    input_par.classList.add("form-control")
    input_par.classList.add("mt-3")
    input_par.classList.add("mr-3")
    input_par.setAttribute("name", "team[]")
    input_par.placeholder = "Team"
    input_point.setAttribute("type", "number")
    input_point.setAttribute("name", "handicap[]")
    input_point.classList.add("form-control")
    input_point.classList.add("mt-3")
    input_point.classList.add("mr-3")
    input_point.placeholder = "Handicap"
    div.appendChild(input_par)
    input_par.insertAdjacentElement("afterend", input_point)
    let last_div = form_team.lastElementChild
    last_div.insertAdjacentElement("afterend", div)
}

function venueDeleteConfirmation(vname, vid) {
    let vname_store = prompt(`Type '${vname}' to delete`)

    if(vname_store === vname) {
        let deleteForm = new XMLHttpRequest()

        deleteForm.open("POST", `${url}/posts/venue_delete`)
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
        console.log("Wrong")
    }
}

function deletePar(cname, id) {
    let deletePar = prompt(`Type '${cname}' to delete`)

    if(deletePar === cname) {
        let deleteForm = new XMLHttpRequest()

        deleteForm.open("POST", `${url}/posts/admins_delete_par`)
        deleteForm.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        deleteForm.onreadystatechange = function() {
            if(this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                let dataRespond = deleteForm.response
                setTimeout(function() { location.reload() }, 1000)
                alert(`Successfully deleted par for ${dataRespond}`)
            }
        }
        deleteForm.send(`id=${id}&cname=${cname}`)
    } else {
        console.log("Wrong")
    }
}

function computeScore(cname, id) {
    let tagTo = document.querySelector("#score")
    let computeScore = new XMLHttpRequest()

    computeScore.open("POST", `${url}/posts/compute_venue`)
    computeScore.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
    computeScore.onreadystatechange = function() {
        if(this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            while(tagTo.children) {
                tagTo.removeChild()
            }

            let dataRespond = computeScore.response
            tagTo.appendChild(dataRespond)
        }
    }
    computeScore.send(`compute`)
}

function participantDeleteConfirmation(pname, pid) {
    let pname_store = prompt(`Type '${pname}' to delete`)

    if(pname_store === pname) {
        let deleteForm = new XMLHttpRequest()

        deleteForm.open("POST", `${url}/posts/participant_delete`)
        deleteForm.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        deleteForm.onreadystatechange = function() {
            if(this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                let dataRespond = JSON.parse(deleteForm.response)
                setTimeout(function() { location.reload() }, 1000)
                alert(`Successfully deleted: ${dataRespond.name}`)
            }
        }
        deleteForm.send(`id=${pid}`)
    } else {
        console.log("Wrong")
    }
}