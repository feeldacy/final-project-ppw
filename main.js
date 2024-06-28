function confirmNavigate(destination) {
    const result = confirm(`Are you sure you want to go to ${destination}?`);
    
    if (result) {
        return true; 
    } else {
        alert("Okay, but don't forget to check out their songs!");
        return false; 
    }
}
