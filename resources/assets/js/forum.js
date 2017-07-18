function gotToNewTopics(response) {
    let data = JSON.parse(response.data);
    window.location = data.location;
}