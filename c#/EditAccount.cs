using TMPro;
using UnityEngine;
using UnityEngine.UI;

public class EditAccount : MonoBehaviour
{
    [Header("UI Elements")]
    public GameObject accountUpdated;
    public TMP_InputField newUsernameInputField;
    public TMP_InputField newPasswordInputField;
    public TMP_InputField confirmPasswordInputField;
    public TextMeshProUGUI infoText;
    public Button submitButton;
    public Color warningColor;
    public Color normalColor;

    [Header("Customization Options")]
    public int minUsernameLength = 3;
    public int maxUsernameLength = 16;
    public int minPasswordLength = 6;
    public int maxPasswordLength = 32;

    private void Awake()
    {
        submitButton.onClick.AddListener(Submit);
        newUsernameInputField.onValueChanged.AddListener(ValidateInput);
        newPasswordInputField.onValueChanged.AddListener(ValidateInput);
        confirmPasswordInputField.onValueChanged.AddListener(ValidateInput);
    }

    public void ValidateInput(string input)
    {
        string newUsername = newUsernameInputField.text.Trim();
        string newPassword = newPasswordInputField.text;
        string confirmPassword = confirmPasswordInputField.text;

        if (newUsername.Length < minUsernameLength || newUsername.Length > maxUsernameLength)
        {
            infoText.text = $"New username must be between {minUsernameLength} and {maxUsernameLength} characters.";
            infoText.color = warningColor;
            infoText.gameObject.SetActive(true);
            return;
        }

        if (newPassword.Length < minPasswordLength || newPassword.Length > maxPasswordLength)
        {
            infoText.text = $"New password must be between {minPasswordLength} and {maxPasswordLength} characters.";
            infoText.color = warningColor;
            infoText.gameObject.SetActive(true);
            return;
        }

        if (newPassword != confirmPassword)
        {
            infoText.text = "Passwords do not match.";
            infoText.color = warningColor;
            infoText.gameObject.SetActive(true);
            return;
        }

        infoText.text = "Press enter to update account.";
        infoText.color = normalColor;
        infoText.gameObject.SetActive(true);
    }

    public void Submit()
    {
        string newUsername = newUsernameInputField.text.Trim();
        string newPassword = newPasswordInputField.text;
        string confirmPassword = confirmPasswordInputField.text;

        if (newUsername.Length < minUsernameLength || newUsername.Length > maxUsernameLength)
        {
            infoText.text = $"New username must be between {minUsernameLength} and {maxUsernameLength} characters.";
            infoText.color = warningColor;
            infoText.gameObject.SetActive(true);
            return;
        }

        if (newPassword.Length < minPasswordLength || newPassword.Length > maxPasswordLength)
        {
            infoText.text = $"New password must be between {minPasswordLength} and {maxPasswordLength} characters.";
            infoText.color = warningColor;
            infoText.gameObject.SetActive(true);
            return;
        }

        if (newPassword != confirmPassword)
        {
            infoText.text = "Passwords do not match.";
            infoText.color = warningColor;
            infoText.gameObject.SetActive(true);
            return;
        }

        // Update the user's account, for example using a server API call.
        // If the update is successful, proceed with the following:

        accountUpdated.SetActive(true);
        this.gameObject.SetActive(false);
    }
}
