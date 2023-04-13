using TMPro;
using UnityEngine;
using UnityEngine.UI;

public class ViewAccount : MonoBehaviour
{
    [Header("UI Elements")]
    public TextMeshProUGUI usernameText;
    public TextMeshProUGUI emailText;
    public Button editAccountButton;

    private string currentUsername;
    private string currentEmail;

    private void Awake()
    {
        editAccountButton.onClick.AddListener(OpenEditAccount);
    }

    private void OnEnable()
    {
        LoadAccountInfo();
    }

    private void LoadAccountInfo()
    {
        // Retrieve the user's account information, for example using a server API call.
        // For demonstration purposes, we'll use placeholders for the username and email.
        currentUsername = "SampleUser";
        currentEmail = "sample@example.com";

        usernameText.text = $"Username: {currentUsername}";
        emailText.text = $"Email: {currentEmail}";
    }

    public void OpenEditAccount()
    {
        // Open the EditAccount scene or panel
    }
}
